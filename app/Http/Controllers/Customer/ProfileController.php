<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use App\Organization;
use App\Profile;
use Illuminate\Http\Request;
use Session;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $profile = Profile::All();
        return view('admin.profile.index', compact('profile'));
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
        $html = view('admin.profile.create',compact('users','organizations'))->render();
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
           'user_id' => 'required',
           'organization_id' => 'required'
           ]);
        try {
            Profile::create($request->all());
            Session::flash('alert-success', 'Creado con exito!');
        } 
        catch (\Illuminate\Database\QueryException $e) {
            Session::flash('alert-danger', 'Error al crear en la BD!');
        }
        return redirect('admin/profile');
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
        $profile = Profile::findOrFail($id);
        $html = view('admin.profile.show', compact('profile'))->render();
        if(Auth::user()->profile->id == $id){
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
        $users = User::select('id', 'name')->get();
        $users = $users->pluck('name', 'id');
        $organizations = Organization::select('id', 'name')->get();
        $organizations = $organizations->pluck('name', 'id');
        $profile = Profile::findOrFail($id);
        $profile_user = $profile->user_id;
        $profile_organization = $profile->organization_id;
        $html = view('admin.profile.edit', compact('profile','users','organizations','profile_user','profile_organization'))->render();
        if(Auth::user()->profile->id == $id){
            return response()->json(['html' => $html]); 
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
           'user_id' => 'required',
           'organization_id' => 'required'
           ]);
        try {
            $profile = Profile::findOrFail($id);
            if(Auth::user()->profile->id == $id){
                $profile->update($request->all());
                Session::flash('alert-success', 'Actualizado con exito!');
            }
            else{
                return view('errors.404');
            }
        } 
        catch (\Illuminate\Database\QueryException $e) {
            Session::flash('alert-danger', 'Error al actualizar en la BD!');
        }
        return redirect('admin/profile');
    }
}
