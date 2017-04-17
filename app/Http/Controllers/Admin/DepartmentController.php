<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Country;
use App\Department;
use Illuminate\Http\Request;
use Session;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $department = Department::All();
        return view('admin.department.index', compact('department'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $countries = Country::select('id', 'name')->get();
        $countries = $countries->pluck('name', 'id');
        $html = view('admin.department.create',compact('countries'))->render();
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
           'country_id' => 'required'
           ]);
        try {
            Department::create($request->all());
            Session::flash('alert-success', 'Creado con exito!');
        } 
        catch (\Illuminate\Database\QueryException $e) {
            Session::flash('alert-danger', 'Error al crear en la BD!');
        }
        return redirect('admin/department');
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
        $department = Department::findOrFail($id);
        $html = view('admin.department.show', compact('department'))->render();
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
        $countries = Country::select('id', 'name')->get();
        $countries = $countries->pluck('name', 'id');
        $department = Department::findOrFail($id);
        $department_country = $department->country_id;
        $html = view('admin.department.edit', compact('department','countries','department_country'))->render();
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
           'country_id' => 'required'
           ]);
        try {
            $department = Department::findOrFail($id);
            $department->update($request->all());
            Session::flash('alert-success', 'Actualizado con exito!');
        } 
        catch (\Illuminate\Database\QueryException $e) {
            Session::flash('alert-danger', 'Error al actualizar en la BD!');
        }
        return redirect('admin/department');
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
        Department::destroy($id);
        Session::flash('alert-success', 'Eliminado con exito!');
        return redirect('admin/department');
    }
}
