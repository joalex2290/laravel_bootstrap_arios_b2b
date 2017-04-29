<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use \Cart;
use Auth;
use App\Order;
use App\OrderDetail;
use App\OrderLog;
use App\Office;
use App\Catalog;
use App\Quote;
use App\QuoteDetail;
use App\DocumentNumber;
use Mail;
use Session;

class CartController extends Controller {

  public function getCart() {
    if (Session::has('catalog')) {
      $cart = Cart::instance(Session::get('catalog'))->content();
    } else {
      $cart = Cart::instance('default')->content();
    }
    $subtotal = Cart::subtotal();
    $tax = Cart::tax();
    $total = Cart::total();
    $template_array = ['cart' => $cart,
    'subtotal' => $subtotal,
    'tax' => $tax,
    'total' => $total
    ];
    return view('cart.index', $template_array);
  }

  public function getAddProduct(Request $request) {

    if(Auth::guest()){
      Cart::instance('default')->add($request->product_id, $request->name, $request->quantity, 0);
    }
    else{
      $catalog = Catalog::find(Session::get('catalog'));
      $catalog_id = $catalog->id;
      $catalog_code = $catalog->code;
      $product_id = $request->product_id;
      $product_code = $request->code;
      $product_name = $request->name;
      $quantity = $request->quantity;
      $tax = $request->tax;
      $price = $request->price;

      Cart::instance(Session::get('catalog'))->add($product_id, $product_name, $quantity, $price, [
        'code' => $product_code,
        'catalog_id' => $catalog_id,
        'catalog_code' => $catalog_code,
        'tax' => $tax,
        ]);

      $rows = Cart::content();
      $rowId = $rows->where('id', $product_id)->first()->rowId;
      Cart::setTax($rowId, $tax);
    }
    $request->session()->flash('alert-success', 'Agregado con exito!');
    return response()->json(['success' => 1]);
  }

  public function getAddAllProducts(Request $request) {

    $catalog = Catalog::find(Session::get('catalog'));
    $catalog_id = $catalog->id;
    $catalog_code = $catalog->code;
    $product_id = $request->id;
    $product_code = $request->code;
    $product_name = $request->name;
    $quantity = $request->quantity;
    $tax = $request->tax;
    $price = $request->price;

    foreach ($product_id as $key => $value) {
      if(empty($quantity[$key])){
        $quantity[$key] = 0;
      }
      else{
        Cart::instance(Session::get('catalog'))->add($value, $product_name[$key], $quantity[$key], $price[$key], [
          'code' => $product_code[$key],
          'catalog_id' => $catalog_id,
          'catalog_code' => $catalog_code,
          'tax' => $tax[$key],
          ]);
        $rows = Cart::content();
        $rowId = $rows->where('id', $value)->first()->rowId;
        Cart::setTax($rowId, $tax[$key]);
      }
    }

    return redirect(route('cart'));
  }

  public function getUpdateProductQty(Request $request) {
    $rowId = $request->rowId;
    $quantity = $request->quantity;
    Cart::instance(Session::get('catalog'))->update($rowId, $quantity);
    $request->session()->flash('alert-success', 'Actualizado con exito!');
    return response()->json(['success' => 1]);
  }

  public function getRemoveProduct(Request $request) {
    $rowId = $request->rowId;
    Cart::instance(Session::get('catalog'))->remove($rowId);
    $request->session()->flash('alert-warning', 'Eliminado con exito!');
    return response()->json(['success' => 1]);
  }

  public function getDestroyCart() {
    Cart::instance(Session::get('catalog'))->destroy();
    $cart = Cart::content();
    return view('cart.index', [
      'cart' => $cart,
      ]);
  }

  public function getCheckout() {
    $cart_total_qty = Cart::instance(Session::get('catalog'))->count();
    if ($cart_total_qty == 0) {
      return redirect()->route('cart');
    }
    $cart = Cart::content();
    $subtotal = Cart::subtotal();
    $tax = Cart::tax();
    $total = Cart::total();
    $office = Office::find(Session::get('office'));
    $catalog = Catalog::find(Session::get('catalog'));
    return view('cart.checkout', [
      'cart' => $cart,
      'cart_total_qty' => $cart_total_qty,
      'office' => $office,
      'subtotal' => $subtotal,
      'tax' => $tax,
      'total' => $total,
      'catalog' => $catalog,
      ]);
  }

  public function getQuote(Request $request){
    $cart_total_qty = Cart::instance(Session::get('default'))->count();
    return view('cart.quote',compact('cart_total_qty'));
  }

  public function postQuote(Request $request){
    $cart_total_qty = Cart::instance(Session::get('default'))->count();
    if ($cart_total_qty == 0) {
      return redirect()->route('cart');
    }
    else{
     $cart = Cart::content();
     $this->validate($request, [
      'name' => 'required',
      'email' => 'required',
      'phone' => 'required',
      'address' => 'required',
      'department_id' => 'required',
      'city_id' => 'required'
      ]);
   }
   try {
    $quote = Quote::create($request->all());
    $quote_number = "Q".date("YmdHis");
    $quote->quote_number = $quote_number;
    $quote->save();
    $line = 1;
    foreach ($cart as $cart_item) {
      $quote_item = new QuoteDetail();
      $quote_item->line = $line;
      $quote_item->quote_id = $quote->id;
      $quote_item->product_id = $cart_item->id;
      $quote_item->product_name = $cart_item->name;
      $quote_item->quantity = $cart_item->qty;
      $quote_item->price = 0;
      $quote_item->tax_prct = 19;
      $quote_item->tax = 0;
      $quote_item->price_tax = 0;
      $quote_item->save();
      $line++;
    }
    Session::flash('alert-success', 'Cotización solicitada con exito, el numero de consulta es: '.$quote->quote_number);
    
    $body  = "<p>Su cotización esta en proceso, puede consultarla con el numero: <a href='".url('search-quote?quote='.$quote->quote_number)."' target='_blank' >".$quote->quote_number."</a></p>";

    $data = ['to' => $request->email, 'quote_num' => $quote->quote_number, 'body' => $body];

    Mail::raw('Text to e-mail', function ($message) use ($data) {
      $message->to($data['to'])
      ->from('postmaster@arioscolombia.com.co')
      ->subject('Cotizacion en Arios Colombia #'.$data['quote_num'])
      ->setBody($data['body'],'text/html');
    });
  } 
  catch (\Illuminate\Database\QueryException $e) {
    Session::flash('alert-danger', 'Error al crear en la BD!');
  }

  Cart::destroy();
  return view('cart.quote',compact('quote_number'));
}

public function postCheckout(Request $request) {
  $cart_total_qty = Cart::instance(Session::get('catalog'))->count();
  if ($cart_total_qty == 0) {
    return redirect()->route('cart');
  }
  else{
   $cart = Cart::content();
   $office = Office::find($request->input('office_id'));
   $catalog = Catalog::find($request->input('catalog_id'));
   $doc_num = DocumentNumber::where('organization_id', $office->organization_id)->first();
   $comment = $request->input('comment');
   $reference = $request->input('reference');
   $order_log = new OrderLog();
   $order = new Order();
   $order->doc_num = $doc_num->next_number;
   $order->user_id = Auth::user()->id;
   $order->user_name = Auth::user()->name;
   $order->office_id = $office->id;
   $order->office_name = $office->name;
   $order->organization_id = $office->organization->id;
   $order->organization_name = $office->organization->name;
   $order->catalog_id = $catalog->id;
   $order->catalog_name = $catalog->name;
   if(Auth::user()->hasRole('administrador') || Auth::user()->hasRole('supervisor')) {
     $order->status = 3;
     $order_log->comment = "Pedido solicitado y autorizado por empresa";
   } elseif (Auth::user()->hasRole('revisor')) {
     $order->status = 2;
     $order_log->comment = "Pedido solicitado y autorizado en oficina";
   } elseif(Auth::user()->hasRole('ordenador')) {
     $order->status = 1;
     $order_log->comment = "Pedido solicitado, pendiente por aprobacion";
   }
   $order->subtotal = Cart::subtotal();
   $order->tax = Cart::tax();
   $order->total = Cart::total();
   $order->comment = $comment;
   $order->reference = $reference;
   $order->address = $office->address;
   $order->city_id = $office->city->id;
   $order->city_name = $office->city->name;
   $order->department_name = $office->city->department->name;
   $order->country_name = $office->city->department->country->name;
   $order->contact_name = $office->contact_name;
   $order->contact_phone = $office->contact_phone;
   $order->contact_cellphone = $office->contact_cellphone;
   $order->contact_email = $office->contact_email;
   $order->save();

   $order_log->comment = $order_log->comment."\r\nReferencia: ".$reference;
   $order_log->comment = $order_log->comment."\r\nComentario: ".$comment;
   $order_log->attachment_type = 0;
   $order_log->order_id = $order->id;
   $order_log->from = Auth::user()->name;
   $order_log->to = "Sin asignar";
   $order_log->save();

   $doc_num->current_number = $doc_num->next_number;
   $doc_num->next_number = $doc_num->next_number + 1;
   $doc_num->save();

   $line = 1;
   foreach ($cart as $cart_item) {
    $order_item = new OrderDetail();
    $order_item->line = $line;
    $order_item->order_id = $order->id;
    $order_item->product_id = $cart_item->id;
    $order_item->product_code = $cart_item->options->code;
    $order_item->product_name = $cart_item->name;
    $order_item->quantity = $cart_item->qty;
    if(Auth::user()->hasRole('administrador') || Auth::user()->hasRole('supervisor')) {
      $order_item->approved_quantity = $cart_item->qty;
    } 
    else {
      $order_item->approved_quantity = 0;
    }
    $order_item->open_quantity = $cart_item->qty;
    $order_item->price = $cart_item->price;
    $order_item->tax_prct = $cart_item->options->tax;
    $order_item->tax = $cart_item->price * ($cart_item->options->tax / 100);
    $order_item->price_tax = ($cart_item->price * (1 + ($cart_item->options->tax / 100)));
    $order_item->save();
    $line++;
  }

    $body  = "<p>Su pedido #".$order->id." fue solicitado con exito.</p>";

    $data = ['to' => Auth::user()->email, 'order_id' => $order->id, 'body' => $body];

    Mail::raw('Text to e-mail', function ($message) use ($data) {
      $message->to($data['to'])
      ->from('postmaster@arioscolombia.com.co')
      ->subject('Notificación pedido#'.$data['order_id'])
      ->setBody($data['body'],'text/html');
    });

  Session::forget('office');
  Session::forget('catalog');
  Cart::destroy();
  Session::flash('alert-success', 'Pedido solicitado con exito!');
  return view('cart.checkout');
}
}

}
