<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\OrderDetail;
use Illuminate\Http\Request;
use Session;

class OrderDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $orderdetail = OrderDetail::All();
        return view('admin.order-detail.index', compact('orderdetail'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $html = view('admin.order-detail.create')->render();
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
			'line' => 'required',
			'order_id' => 'required',
			'product_id' => 'required',
			'product_code' => 'required',
			'product_name' => 'required',
			'quantity' => 'required',
			'approved_quantity' => 'required',
			'open_quantity' => 'required',
			'price' => 'required',
			'tax_prct' => 'required',
			'tax' => 'required',
			'price_tax' => 'required'
		]);
        try {
            OrderDetail::create($request->all());
            Session::flash('alert-success', 'Creado con exito!');
        } 
        catch (\Illuminate\Database\QueryException $e) {
            Session::flash('alert-danger', 'Error al crear en la BD!');
        }
        return redirect('admin/order-detail');
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
        $orderdetail = OrderDetail::findOrFail($id);
        $html = view('admin.order-detail.show', compact('orderdetail'))->render();
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
        $orderdetail = OrderDetail::findOrFail($id);
        $html = view('admin.order-detail.edit', compact('orderdetail'))->render();
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
			'line' => 'required',
			'order_id' => 'required',
			'product_id' => 'required',
			'product_code' => 'required',
			'product_name' => 'required',
			'quantity' => 'required',
			'approved_quantity' => 'required',
			'open_quantity' => 'required',
			'price' => 'required',
			'tax_prct' => 'required',
			'tax' => 'required',
			'price_tax' => 'required'
		]);
        try {
            $orderdetail = OrderDetail::findOrFail($id);
            $orderdetail->update($request->all());
            Session::flash('alert-success', 'Actualizado con exito!');
        } 
        catch (\Illuminate\Database\QueryException $e) {
            Session::flash('alert-danger', 'Error al actualizar en la BD!');
        }
        return redirect('admin/order-detail');
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
        OrderDetail::destroy($id);
        Session::flash('alert-success', 'Eliminado con exito!');
        return redirect('admin/order-detail');
    }
}
