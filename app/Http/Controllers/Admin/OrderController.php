<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use App\Organization;
use App\Office;
use App\Catalog;
use App\City;
use App\Order;
use Illuminate\Http\Request;
use Session;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $order = Order::All();
        return view('admin.order.index', compact('order'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $users = User::select('id', 'name')->get();
        $users = $users->pluck('name', 'id');
        $organizations = Organization::select('id', 'name')->get();
        $organizations = $organizations->pluck('name', 'id');
        $offices = Office::select('id', 'name')->get();
        $offices = $offices->pluck('name', 'id');
        $catalogs = Catalog::select('id', 'name')->get();
        $catalogs = $catalogs->pluck('name', 'id');
        $cities = City::select('id', 'name')->get();
        $cities = $cities->pluck('name', 'id');
        $html = view('admin.order.create',compact('users','organizations','offices','catalogs','cities'))->render();
        return response()->json(['html' => $html]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $this->validate($request, [
         'doc_num' => 'required',
         'user_id' => 'required',
         'user_name' => 'required',
         'office_id' => 'required',
         'office_name' => 'required',
         'organization_id' => 'required',
         'organization_name' => 'required',
         'catalog_id' => 'required',
         'catalog_name' => 'required',
         'status' => 'required',
         'subtotal' => 'required',
         'tax' => 'required',
         'total' => 'required',
         'address' => 'required',
         'city_id' => 'required',
         'city_name' => 'required',
         'department_name' => 'required',
         'country_name' => 'required',
         'contact_name' => 'required',
         'contact_phone' => 'required',
         'contact_email' => 'required'
         ]);
        try {
            Order::create($request->all());
            Session::flash('alert-success', 'Creado con exito!');
        } 
        catch (\Illuminate\Database\QueryException $e) {
            Session::flash('alert-danger', 'Error al crear en la BD!');
        }
        return redirect('admin/order');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $order = Order::findOrFail($id);
        $html = view('admin.order.show', compact('order'))->render();
        return response()->json(['html' => $html]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $users = User::select('id', 'name')->get();
        $users = $users->pluck('name', 'id');
        $organizations = Organization::select('id', 'name')->get();
        $organizations = $organizations->pluck('name', 'id');
        $offices = Office::select('id', 'name')->get();
        $offices = $offices->pluck('name', 'id');
        $catalogs = Catalog::select('id', 'name')->get();
        $catalogs = $catalogs->pluck('name', 'id');
        $cities = City::select('id', 'name')->get();
        $cities = $cities->pluck('name', 'id');
        $order = Order::findOrFail($id);
        $order_user = $order->user_id;
        $order_organization = $order->organization_id;
        $order_office = $order->office_id;
        $order_catalog = $order->catalog_id;
        $order_city = $order->city_id;
        $order_seller = $order->seller_id;
        $html = view('admin.order.edit', compact('order','users','organizations','offices','catalogs','cities','order_user_name','order_organization','order_office','order_catalog','order_city','order_seller'))->render();
        return response()->json(['html' => $html]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update($id, Request $request)
    {
        $this->validate($request, [
         'doc_num' => 'required',
         'user_id' => 'required',
         'user_name' => 'required',
         'office_id' => 'required',
         'office_name' => 'required',
         'organization_id' => 'required',
         'organization_name' => 'required',
         'catalog_id' => 'required',
         'catalog_name' => 'required',
         'status' => 'required',
         'subtotal' => 'required',
         'tax' => 'required',
         'total' => 'required',
         'address' => 'required',
         'city_id' => 'required',
         'city_name' => 'required',
         'department_name' => 'required',
         'country_name' => 'required',
         'contact_name' => 'required',
         'contact_phone' => 'required',
         'contact_email' => 'required'
         ]);
        try {
            $order = Order::findOrFail($id);
            $order->update($request->all());
            Session::flash('alert-success', 'Actualizado con exito!');
        } 
        catch (\Illuminate\Database\QueryException $e) {
            Session::flash('alert-danger', 'Error al actualizar en la BD!');
        }
        return redirect('admin/order');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        Order::destroy($id);
        Session::flash('alert-success', 'Eliminado con exito!');
        return redirect('admin/order');
    }
}
