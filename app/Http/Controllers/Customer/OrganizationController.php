<?php

namespace App\Http\Controllers\Customer;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\City;
use App\Organization;
use Illuminate\Http\Request;
use Session;
use Image;
use Auth;
use File;

class OrganizationController extends Controller
{
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
        if(Auth::user()->profile->organization->id == $id){
            return view('customer.organization.show', compact('organization'));  
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
        $cities = City::select('id', 'name')->get();
        $cities = $cities->pluck('name', 'id');
        $organization = Organization::findOrFail($id);
        $organization_city = $organization->city_id;
        if(Auth::user()->profile->organization->id == $id){
            return view('customer.organization.edit', compact('organization','cities','organization_city'));
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
           'tax_id' => 'required',
           'name' => 'required',
           'address' => 'required',
           'city_id' => 'required',
           ]);
        try {
            $organization = Organization::findOrFail($id);
            $current_filename = $organization->avatar_url;
            $organization->update($request->all());
            if ($request->hasFile('avatar_url')) {
                $file = $request->File('avatar_url');
                $filename = "organization_".$id."_". time() . "." . $file->getClientOriginalExtension();

                if($current_filename != "organization-default.png" ){
                    File::delete(public_path("/img/organizations/" .$current_filename ));
                }

                Image::make($file)->fit(300,300)->save(public_path("/img/organizations/" . $filename ));
                $organization->avatar_url = $filename;
                $organization->save();
            }
            Session::flash('alert-success', 'Actualizado con exito!');
        } 
        catch (\Illuminate\Database\QueryException $e) {
            Session::flash('alert-danger', 'Error al actualizar en la BD!');
        }
        return redirect('customer/organization/'.$organization->id);
    }

}
