<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Order;
use App\OrderDetail;
use App\OrderLog;
use App\OrderStatus;
use App\Carrier;
use App\Office;
use App\Organization;
use Auth;
use Carbon\Carbon;
use Session;
use File;
use Zipper;

class OrderController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth');
    }

    public function getMyOrders() {
        $user_orders = Auth::user()->orders()->get();
        return view('shop.orders.my-orders', ['user_orders' => $user_orders]);
    }

    public function getPendingOfficeOrders() {
        $offices = Auth::user()->offices()->get();
        return view('shop.orders.pending-office-orders', ['offices' => $offices]);
    }

    public function getOfficeOrders() {
        $offices = Auth::user()->offices()->get();
        return view('shop.orders.office-orders', ['offices' => $offices]);
    }

    public function getPendingOrganizationOrders() {
        $organization = Organization::find(Auth::user()->profile->organization->id);
        return view('shop.orders.pending-organization-orders', ['organization' => $organization]);
    }

    public function getOrganizationOrders() {
        $organization = Organization::find(Auth::user()->profile->organization->id);
        return view('shop.orders.organization-orders', ['organization' => $organization]);
    }

    public function getAllOrders() {
        $orders = Order::all();
        return view('admin.manage-orders.orders', ['orders' => $orders]);
    }

    public function approveOrder(Request $request) {

        $order = Order::find($request->order_id);
        $order_log = new OrderLog();
        $order_log->order_id = $order->id;
        $order_log->attachment_type = 0;
        $order_log->from = Auth::user()->name;
        $order_log->to = $order->user->name;
        $order->subtotal = $request->subtotal;
        $order->tax = $request->tax;
        $order->total = $request->total;
        if (Auth::user()->hasRole('administrador')||Auth::user()->hasRole('supervisor')) {
            $order->status = 3;
            $order_log->comment = "Autorizado por empresa";
        } else {
            $order->status = 2;
            $order_log->comment = "Autorizado por oficina, pendiente por autorizacion empresa general";
        }
        $order->reviewed_at = Carbon::now();
        if(Auth::user()->profile->organization->id == $order->organization_id){
            $order->save();
            $order_log->save();
        }
        else{
            return view('errors.404');
        }

        foreach ($request->order_detail_id as $index => $id) {

            $order_detail = OrderDetail::find($id);
            $order_detail->approved_quantity = $request->approved_qty[$index];
            $order_detail->open_quantity = $request->approved_qty[$index];
            if ($request->approved_qty[$index] == 0) {
                $order_detail->status = 0;
            }
            $order_detail->save();
        }
        Session::flash('alert-success', 'Pedido aprobado con exito.');
        return redirect('/shop/order/detail?id='.$request->order_id.'&url='.$request->url.'&tab='.$request->tab);
    }

    public function rejectOrder(Request $request) {

        $order = Order::find($request->order_id);
        $order_log = new OrderLog();
        $order_log->order_id = $order->id;
        $order_log->attachment_type = 0;
        $order_log->from = Auth::user()->name;
        $order_log->to = $order->user->name;
        if (Auth::user()->hasRole('administrador')||Auth::user()->hasRole('supervisor')) {
            $order->status = 4;
            $order_log->comment = "Rechazado por empresa";
        } else {
            $order->status = 4;
            $order_log->comment = "Rechazado por oficina";
        }
        $order->reviewed_at = Carbon::now();
        if(Auth::user()->profile->organization->id == $order->organization_id){
            $order->save();
            $order_log->save();
        }
        else{
            return view('errors.404');
        }

        foreach ($order->orderDetails()->get() as $order_detail) {
            $order_detail->status = 0;
            $order_detail->save();
        }
        Session::flash('alert-success', 'Pedido rechazado con exito.');
        return redirect('/shop/order/detail?id='.$request->order_id.'&url='.$request->url.'&tab='.$request->tab);
    }

    public function orderDetails(Request $request) {
        $url = $request->url;
        $tab = $request->tab;
        $order = Order::find($request->id);
        $order_details = $order->orderDetails()->get();
        $order_logs = $order->orderLogs()->get();
        $attachment_types = array(
            0 => 'Sin adjunto',
            1 => 'Remision',
            2 => 'Prueba de entrega',
            3 => 'Factura',
            4 => 'Foto',
            5 => 'Documento',
            );
        if(Auth::user()->profile->organization->id == $order->organization_id){
            return view('shop.orders.order', compact('order', 'order_details', 'order_logs', 'attachment_types', 'url', 'tab')); 
        }
        else{
            return view('errors.404');
        }
    }

    public function postAllOrderDetails(Request $request) {
        $order = Order::find($request->id);
        $order_details = $order->orderDetails()->get();
        $order_logs = $order->orderLogs()->get();
        $url = $request->url;
        $tab = $request->tab;
        $order_statuses = ['-- Estado del pedido --', 'Solicitado', 'Autorizado oficina', 'Autorizado empresa', 'Rechazado', 'En proceso', 'En transito', 'Entregado', 'Devuelto'];
        $carriers = Carrier::all();
        $attachment_types = array(
            0 => 'Sin adjunto',
            1 => 'Remision',
            2 => 'Prueba de entrega',
            3 => 'Factura',
            4 => 'Foto',
            5 => 'Documento',
            );
        return view('admin.manage-orders.order-details', compact('order', 'order_details', 'order_logs', 'order_statuses', 'attachment_types', 'carriers', 'url', 'tab'));
    }

    public function postAddCustomerOrderLog(Request $request) {

        $order_log = new OrderLog();
        $order_log->order_id = $request->order_id;
        $order_log->comment = $request->comment;
        $order_log->attachment_type = $request->attachment_type;
        if($order_log->attachment_type){
            if ($request->hasFile('attachment')) {
                $file_path = $request->attachment->store('order_log_files');
                $order_log->attachment = $file_path;
            }
            else{
                $order_log->attachment_type = 0;
            }
        }
        $order_log->from = Auth::user()->name;
        $order_log->to = "Sin asignar";
        $order_log->save();

        return redirect('/shop/order/detail?id='.$request->order_id.'&url='.$request->url.'&tab='.$request->tab);
    }

    public function postAddOrderLog(Request $request) {

        $order_log = new OrderLog();
        $order_log->order_id = $request->order_id;
        $order_log->comment = $request->comment;
        $order_log->attachment_type = $request->attachment_type;
        if($request->hasFile('attachment')){
            $file_path = $request->attachment->store('order_log_files');
            $order_log->attachment = $file_path;
        }

        $order = Order::find($request->order_id);
        $order->status = $request->status;
        if($request->status == 5){
          $order->seller_id = Auth::user()->id;  
          $order->seller_name = Auth::user()->name;
      }
      if($request->status == 6){
          $order->dispatched_at = Carbon::now();
          $order_log->carrier_id = $request->carrier_id;
          $order_log->tracking_number = $request->tracking_number;
          $order_log->tracking_link = $request->tracking_link;
      }
      if($request->status == 7){
          $order->delivered_at = Carbon::now();
      }

      $order_log->from = Auth::user()->name;
      $order_log->to = $order->user->name;
      $order_log->save();
      $order->save();

      return redirect('admin/manage-orders-details?id='.$request->order_id.'&url='.$request->url.'&tab='.$request->tab);
  }
  public function getSapTemplate(Request $request) {
    $order = Order::findOrFail($request->order_id);
    $order_details = $order->orderDetails()->get();

    $header_content = "DocNum,CardCode,NumAtCard,Comments,DocDate,DocDueDate\r\nDocNum,CardCode,NumAtCard,Comments,DocDate,DocDueDate\r\n1,CN".$order->organization->tax_id.",,Pedido Arios B2B,".date("Ymd").",".date("Ymd");
    $detail_content = "ParentKey,ItemCode,Quantity,Price,ProjectCode\r\nParentKey,ItemCode,Quantity,Price,ProjectCode\r\n";
    $last_key = $order_details->count();
    foreach($order_details as $index => $product){
        if ($index == $last_key) {
            $detail_content = $detail_content."1,".$product->product->code.",".$product->approved_quantity.",".$product->price.",CLIENTES PRIVADOS";
        } else {
            $detail_content = $detail_content."1,".$product->product->code.",".$product->approved_quantity.",".$product->price.",CLIENTES PRIVADOS\r\n";
        }
    }

    $header_file_name = "pedido-encabezado-".date("YmdHis").".csv";
    $header_path = storage_path('app\\templates\\').$header_file_name;
    File::put($header_path,$header_content);

    substr($detail_content, 0, -4);

    $detail_file_name = "pedido-detalle-".date("YmdHis").".csv";
    $detail_path = storage_path('app\\templates\\').$detail_file_name;
    File::put($detail_path,$detail_content);

    $zipname = "pedido-sap-".date("YmdHis").".zip";
    $zip_path = storage_path('app\\templates\\').$zipname;

    $files = [$header_path,$detail_path];
    Zipper::make($zip_path)->add($files)->close();

    return response()->download($zip_path);
}

}
