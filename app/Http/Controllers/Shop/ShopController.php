<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;
use \Cart;
use Auth;
use App\Catalog;
use App\Office;
use App\Product;
use App\Company;
use Session;

class ShopController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return view('index');
    }

    public function getCatalog(Request $request) {

        if (Session::has('catalog')) {
            return redirect()->route('shop.catalog.products');
        } else {
            $request->session()->flash('alert-warning', 'Seleccione un catalogo para comenzar a comprar');
            return view('shop.index');
        }
    }

    public function getOfficeCatalogs(Request $request) {
         $date = date('YY-MM-DD', time());
        if ($request->ajax()) {
            $catalogs = Office::find($request->office_id)->catalogs()->get();
            $data = view('shop.get-office-catalogs', ['catalogs' => $catalogs])->render();
            return response()->json(['options' => $data]);
        }
    }

    public function getSetCatalog(Request $request) {

        if (Session::has('catalog')) {
            return redirect()->route('shop.catalog.products');
        } else {
            Session::put('office', $request->office_id);
            Session::put('catalog', $request->catalog_id);
            Cart::instance($request->catalog_id)->content();
            return redirect()->route('shop.catalog.products');
        }
    }

    public function getUnsetCatalog(Request $request) {

        if (Session::has('catalog')) {
            Session::forget('office');
            Session::forget('catalog');
            Cart::instance('default')->content();
            Session::flash('alert-warning', 'Seleccione una oficina y un catalogo para comenzar con el pedido.');
            return redirect()->route('shop');
        } else {
            return view('shop.index');
        }
    }

    public function getCatalogProducts() {

        if (!Session::has('catalog')) {
            return redirect()->route('shop.catalogs');
        } else {
            $catalog_id = Session::get('catalog');
            //$office = Office::find($request->id_office)->get();
            $catalog = Catalog::find($catalog_id);
            $products = Catalog::find($catalog_id)->products()->get();
            return view('shop.products', [
                'products' => $products,
                'catalog' => $catalog,
                ]);
        }
    }

    public function getProductDetail(Request $request) {
        $product_id = $request->product_id;
        $product = Product::find($product_id);
        $data = view('shop.get-product-details', ['product' => $product])->render();
        return response()->json(['product' => $data]);
    }

    public function imageUpload()
    {
        return view('image-upload');
    }

    /**
    * Manage Post Request
    *
    * @return void
    */
    public function imageUploadPost(Request $request)
    {
        $this->validate($request, [
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

        $imageName = time().'.'.$request->image->getClientOriginalExtension();
        $request->image->move(storage_path('images'), $imageName);

        return back()
        ->with('success','Image Uploaded successfully.')
        ->with('path',$imageName);
    }

}
