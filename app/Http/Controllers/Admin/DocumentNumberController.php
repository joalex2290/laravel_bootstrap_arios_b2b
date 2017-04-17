<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Organization;
use App\DocumentNumber;
use Illuminate\Http\Request;
use Session;

class DocumentNumberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $documentnumber = DocumentNumber::All();
        return view('admin.document-number.index', compact('documentnumber'));
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
        $html = view('admin.document-number.create', compact('organizations'))->render();
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
         'organization_id' => 'required',
         'current_number' => 'required',
         'next_number' => 'required'
         ]);
        try {
            DocumentNumber::create($request->all());
            Session::flash('alert-success', 'Creado con exito!');
        } 
        catch (\Illuminate\Database\QueryException $e) {
            Session::flash('alert-danger', 'Error al crear en la BD!');
        }
        return redirect('admin/document-number');
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
        $documentnumber = DocumentNumber::findOrFail($id);
        $html = view('admin.document-number.show', compact('documentnumber'))->render();
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
        $documentnumber = DocumentNumber::findOrFail($id);
        $doc_organization = $documentnumber->organization_id;
        $html = view('admin.document-number.edit', compact('documentnumber','organizations','doc_organization'))->render();
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
         'organization_id' => 'required',
         'current_number' => 'required',
         'next_number' => 'required'
         ]);
        try {
            $documentnumber = DocumentNumber::findOrFail($id);
            $documentnumber->update($request->all());
            Session::flash('alert-success', 'Actualizado con exito!');
        } 
        catch (\Illuminate\Database\QueryException $e) {
            Session::flash('alert-danger', 'Error al actualizar en la BD!');
        }
        return redirect('admin/document-number');
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
        DocumentNumber::destroy($id);
        Session::flash('alert-success', 'Eliminado con exito!');
        return redirect('admin/document-number');
    }
}
