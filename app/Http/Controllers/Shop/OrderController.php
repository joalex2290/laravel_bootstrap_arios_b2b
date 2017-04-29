<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Quote;
use App\QuoteDetail;
use App\Order;
use App\OrderDetail;
use App\OrderLog;
use App\OrderStatus;
use App\Carrier;
use App\Office;
use App\Organization;
use Auth;
use Carbon\Carbon;
use Mail;
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

        $body  = "<p>Su pedido #".$order->id." fue ".$order_log->comment.".</p>";

        $data = ['to' => $order->user->email, 'order_id' => $order->id, 'body' => $body];

        Mail::raw('Text to e-mail', function ($message) use ($data) {
          $message->to($data['to'])
          ->from('postmaster@arioscolombia.com.co')
          ->subject('Notificación pedido#'.$data['order_id'])
          ->setBody($data['body'],'text/html');
        });

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

        $body  = "<p>Su pedido #".$order->id." fue ".$order_log->comment.".</p>";

        $data = ['to' => $order->user->email, 'order_id' => $order->id, 'body' => $body];

        Mail::raw('Text to e-mail', function ($message) use ($data) {
          $message->to($data['to'])
          ->from('postmaster@arioscolombia.com.co')
          ->subject('Notificación pedido#'.$data['order_id'])
          ->setBody($data['body'],'text/html');
        });

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

    public function getOrderDetails(Request $request) {
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

        $body  = "<p>Su pedido #".$order->id." tiene un comentario: ".$order_log->comment.".</p>";

        $data = ['to' => $order->user->email, 'order_id' => $order->id, 'body' => $body];

        Mail::raw('Text to e-mail', function ($message) use ($data) {
          $message->to($data['to'])
          ->from('postmaster@arioscolombia.com.co')
          ->subject('Notificación pedido#'.$data['order_id'])
          ->setBody($data['body'],'text/html');
        });

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

    public function getQuote() {
        $quotes= Quote::all();
        return view('admin.manage-quotes.quotes', compact('quotes'));
    }

    public function postQuote(Request $request) {

        $quote = quote::find($request->quote_id);
        $quote->subtotal = $request->subtotal;
        $quote->tax = $request->tax;
        $quote->total = $request->total;
        $quote->shipping = $request->shipping;
        $quote->status = 1;
        $quote->save();

        foreach ($request->quote_detail_id as $index => $id) {

            $quote_detail = quoteDetail::find($id);
            $quote_detail->price = $request->price[$index];
            $quote_detail->tax = $request->price[$index]*($request->product_tax[$index]/100);
            $quote_detail->price_tax = $request->price[$index] + ($request->price[$index]*($request->product_tax[$index]/100));
            $quote_detail->save();
        }
        $body  = "<p>Su cotización esta lista!, puede consultarla con el numero: <a href='".url('search-quote?quote='.$quote->quote_number)."' target='_blank' >".$quote->quote_number."</a></p>";

        $data = ['to' => $quote->email, 'quote_num' => $quote->quote_number, 'body' => $body];

        Mail::raw('Text to e-mail', function ($message) use ($data) {
          $message->to($data['to'])
          ->from('postmaster@arioscolombia.com.co')
          ->subject('Cotizacion lista de Arios Colombia #'.$data['quote_num'])
          ->setBody($data['body'],'text/html');
        });


        Session::flash('alert-success', 'Cotización creada con exito.');
        return redirect('/admin/manage-quotes-details?id='.$request->quote_id.'&url='.$request->url.'&tab='.$request->tab);
    }

    public function getQuoteDetails(Request $request) {
        $quote = Quote::find($request->id);
        $quote_details = $quote->quoteDetails()->get();
        $url = $request->url;
        $tab = $request->tab;
        return view('admin.manage-quotes.quote-details', compact('quote', 'quote_details', 'url', 'tab'));
    }

}
