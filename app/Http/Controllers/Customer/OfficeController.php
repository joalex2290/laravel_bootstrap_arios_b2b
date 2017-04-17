<?php

namespace App\Http\Controllers\Customer;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Organization;
use App\Department;
use App\City;
use App\Office;
use Illuminate\Http\Request;
use Session;
use Auth;
use Image;
use File;

class OfficeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $organization = Organization::findOrFail(Auth::user()->profile->organization->id);
        $offices = $organization->offices()->get();
        $catalogs = $organization->catalogs()->get();
        $office_types = ['Oficina', 'Sucursal', 'Departamento', 'Seccion', 'Centro de costo', 'Regional', 'Bodega'];
        return view('customer.offices.index', compact('offices','office_types','catalogs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $organization = Organization::findOrFail(Auth::user()->profile->organization->id);
        $departments = Department::select('id', 'name')->get();
        $departments = $departments->pluck('name', 'id');
        return view('customer.offices.create',compact('organization','departments'));
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
            if(Auth::user()->profile->organization->id == $request->organization_id){
                $office = Office::create($request->all());
                if ($request->hasFile('avatar_url')) {
                    $file = $request->File('avatar_url');
                    $filename = "office_". $office->id. "_" . time() . "." . $file->getClientOriginalExtension();
                    Image::make($file)->fit(300,300)->save(public_path("/img/offices/" . $filename ));
                    $office->avatar_url = $filename;
                    $office->save();
                }
                $office->addUser(Auth::user());
                Session::flash('alert-success', 'Creado con exito!'); 
            }
            else{
                return view('errors.404');
            }
        } 
        catch (\Illuminate\Database\QueryException $e) {
            Session::flash('alert-danger', 'Error al crear en la BD!'.$e);
        }
        return redirect('customer/offices');
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
        $html = view('customer.offices.show', compact('office','office_types'))->render();
        if(Auth::user()->profile->organization->id == $office->organization_id){
            return response()->json(['html' => $html]); 
        }
        else{
            return view('errors.404');
        }
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
        $departments = Department::select('id', 'name')->get();
        $departments = $departments->pluck('name', 'id');
        $office = Office::findOrFail($id);
        $organization = Organization::findOrFail($office->organization_id);
        $office_city = $office->city_id;
        $city = City::findOrFail($office->city_id);
        $office_department = $city->department_id;
        if(Auth::user()->profile->organization->id == $office->organization_id){
            return view('customer.offices.edit', compact('office','organization','departments','office_city','office_department'));
        }
        else{
            return view('errors.404');
        }
        
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
            $current_filename = $office->avatar_url;
            $office->update($request->all());
            if ($request->hasFile('avatar_url')) {
                $file = $request->File('avatar_url');
                $filename = "office_".$id."_". time() . "." . $file->getClientOriginalExtension();

                if($current_filename != "office-default.png" ){
                    File::delete(public_path("/img/offices/" .$current_filename ));
                }

                Image::make($file)->fit(300,300)->save(public_path("/img/offices/" . $filename ));
                $office->avatar_url = $filename;
                $office->save();
            }
            Session::flash('alert-success', 'Actualizado con exito!');
        } 
        catch (\Illuminate\Database\QueryException $e) {
            Session::flash('alert-danger', 'Error al actualizar en la BD!');
        }
        return redirect('customer/offices');
    }

}
