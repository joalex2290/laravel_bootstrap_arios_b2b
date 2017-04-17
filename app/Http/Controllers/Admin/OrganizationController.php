<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\City;
use App\Organization;
use Illuminate\Http\Request;
use Session;

class OrganizationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $organization = Organization::All();
        return view('admin.organization.index', compact('organization'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $cities = City::select('id', 'name')->get();
        $cities = $cities->pluck('name', 'id');
        $html = view('admin.organization.create', compact('cities'))->render();
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
         'tax_id' => 'required',
         'name' => 'required',
         'address' => 'required',
         'city_id' => 'required',
         ]);
        try {
            Organization::create($request->all());
            Session::flash('alert-success', 'Creado con exito!');
        } 
        catch (\Illuminate\Database\QueryException $e) {
            Session::flash('alert-danger', 'Error al crear en la BD!'.$e);
        }
        return redirect('admin/organization');
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
        $organization = Organization::findOrFail($id);
        $html = view('admin.organization.show', compact('organization'))->render();
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
        $cities = City::select('id', 'name')->get();
        $cities = $cities->pluck('name', 'id');
        $organization = Organization::findOrFail($id);
        $organization_city = $organization->city_id;
        $html = view('admin.organization.edit', compact('organization','cities','organization_city'))->render();
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
         'tax_id' => 'required',
         'name' => 'required',
         'address' => 'required',
         'city_id' => 'required',
         ]);
        try {
            $organization = Organization::findOrFail($id);
            $organization->update($request->all());
            Session::flash('alert-success', 'Actualizado con exito!');
        } 
        catch (\Illuminate\Database\QueryException $e) {
            Session::flash('alert-danger', 'Error al actualizar en la BD!');
        }
        return redirect('admin/organization');
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
        Organization::destroy($id);
        Session::flash('alert-success', 'Eliminado con exito!');
        return redirect('admin/organization');
    }
}
