<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Organization;
use App\Catalog;
use Illuminate\Http\Request;
use Session;

class CatalogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $catalog = Catalog::All();
        return view('admin.catalog.index', compact('catalog'));
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
        $html = view('admin.catalog.create', compact('organizations'))->render();
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
           'organization_id' => 'required',
           'valid_from' => 'required',
           'valid_to' => 'required'
           ]);
        try {
            Catalog::create($request->all());
            Session::flash('alert-success', 'Creado con exito!');
        } 
        catch (\Illuminate\Database\QueryException $e) {
            Session::flash('alert-danger', 'Error al crear en la BD!');
        }
        return redirect('admin/catalog');
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
        $catalog = Catalog::findOrFail($id);
        $html = view('admin.catalog.show', compact('catalog'))->render();
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
        $catalog = Catalog::findOrFail($id);
        $catalog_organization = $catalog->organization_id;
        $html = view('admin.catalog.edit', compact('catalog','organizations','catalog_organization'))->render();
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
           'organization_id' => 'required',
           'valid_from' => 'required',
           'valid_to' => 'required'
           ]);
        try {
            $catalog = Catalog::findOrFail($id);
            $catalog->update($request->all());
            Session::flash('alert-success', 'Actualizado con exito!');
        } 
        catch (\Illuminate\Database\QueryException $e) {
            Session::flash('alert-danger', 'Error al actualizar en la BD!');
        }
        return redirect('admin/catalog');
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
        Catalog::destroy($id);
        Session::flash('alert-success', 'Eliminado con exito!');
        return redirect('admin/catalog');
    }
}
