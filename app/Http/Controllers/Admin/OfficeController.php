<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Organization;
use App\City;
use App\Office;
use Illuminate\Http\Request;
use Session;

class OfficeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $office = Office::All();
        $office_types = ['Oficina', 'Sucursal', 'Departamento', 'Seccion', 'Centro de costo', 'Regional', 'Bodega'];
        return view('admin.office.index', compact('office','office_types'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $organizations = Organization::select('id', 'name')->get();
        $organizations = $organizations->pluck('name', 'id');
        $cities = City::select('id', 'name')->get();
        $cities = $cities->pluck('name', 'id');
        $html = view('admin.office.create',compact('organizations','cities'))->render();
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
           'code' => 'required',
           'name' => 'required',
           'type' => 'required',
           'organization_id' => 'required',
           'phone' => 'required',
           'address' => 'required',
           'city_id' => 'required',
           'contact_name' => 'required',
           'contact_phone' => 'required',
           'contact_email' => 'required'
           ]);
        try {
            Office::create($request->all());
            Session::flash('alert-success', 'Creado con exito!');
        } 
        catch (\Illuminate\Database\QueryException $e) {
            Session::flash('alert-danger', 'Error al crear en la BD!'.$e);
        }
        return redirect('admin/office');
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
        $office_types = ['Oficina', 'Sucursal', 'Departamento', 'Seccion', 'Centro de costo', 'Regional', 'Bodega'];
        $office = Office::findOrFail($id);
        $html = view('admin.office.show', compact('office','office_types'))->render();
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
        $organizations = Organization::select('id', 'name')->get();
        $organizations = $organizations->pluck('name', 'id');
        $cities = City::select('id', 'name')->get();
        $cities = $cities->pluck('name', 'id');
        $office = Office::findOrFail($id);
        $office_organization = $office->organization_id;
        $office_city = $office->city_id;
        $html = view('admin.office.edit', compact('office','organizations','cities','office_organization','office_city'))->render();
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
           'code' => 'required',
           'name' => 'required',
           'type' => 'required',
           'organization_id' => 'required',
           'phone' => 'required',
           'address' => 'required',
           'city_id' => 'required',
           'contact_name' => 'required',
           'contact_phone' => 'required',
           'contact_email' => 'required'
           ]);
        try {
            $office = Office::findOrFail($id);
            $office->update($request->all());
            Session::flash('alert-success', 'Actualizado con exito!');
        } 
        catch (\Illuminate\Database\QueryException $e) {
            Session::flash('alert-danger', 'Error al actualizar en la BD!');
        }
        return redirect('admin/office');
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
        Office::destroy($id);
        Session::flash('alert-success', 'Eliminado con exito!');
        return redirect('admin/office');
    }
}
