<?php

namespace App\Http\Controllers\Customer;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Organization;
use App\Office;
use App\User;
use App\Profile;
use App\Role;
use Illuminate\Http\Request;
use Session;
use Auth;

class UserController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return void
     */
    public function index()
    {
    	$organization = Organization::findOrFail(Auth::user()->profile->organization->id);
    	$organization_users = $organization->profiles()->get();
    	$office_users = Auth::user()->offices()->get();
    	return view('customer.users.index', compact('organization_users', 'office_users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return void
     */
    public function create()
    {
        if(Auth::user()->hasRole('administrador')){
            $roles = ['supervisor' => 'Supervisor de oficina', 'revisor' => 'Revisor de pedidos', 'ordenador' => 'Generador del gasto'];
            $organization = Organization::findOrFail(Auth::user()->profile->organization->id);
            $offices = $organization->offices()->get();
            $offices = $offices->pluck('name','id');
        }
        else{
            $roles = ['ordenador' => 'Generador del gasto'];
            $offices = Auth::user()->offices()->get();
            $offices = $offices->pluck('name','id');
        }


        $html = view('customer.users.create', compact('roles','offices'))->render();
        return response()->json(['html' => $html]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return void
     */
    public function store(Request $request)
    {
    	$this->validate($request, [
    		'name' => 'required', 
    		'email' => 'required', 
    		'password' => 'required', 
    		'role' => 'required',
    		'offices' => 'required'
    		]);
    	$data = $request->except('password');
    	$data['password'] = bcrypt($request->password);
    	try {
    		$user = User::create($data);
    		$user->assignRole($request->role);
    		foreach ($request->offices as $office) {
    			$user->addUserTo(Office::findOrFail($office));
    		};
    		$profile = new Profile();
    		$profile->user_id = $user->id;
    		$profile->organization_id = Auth::user()->profile->organization->id;
    		$profile->save();
    		Session::flash('alert-success', 'Creado con exito!');
    	} 
    	catch (\Illuminate\Database\QueryException $e) {
    		Session::flash('alert-danger', 'Error al crear en la BD!');
    	}    
    	return redirect('customer/users');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return void
     */
    public function show($id)
    {
    	$user = User::findOrFail($id);
    	foreach ($user->roles as $role) {
    		$user_roles[] = $role->label;
    	}
    	$html = view('customer.users.show', compact('user','user_roles'))->render();
        if(Auth::user()->profile->organization->id == $user->profile->organization->id){
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
     * @return void
     */
    public function edit($id)
    {
    	$user = User::with('roles')->select('id', 'name', 'email')->findOrFail($id);
    	$user_roles = [];
    	foreach ($user->roles as $role) {
    		$user_roles[] = $role->name;
    	}

        if(Auth::user()->hasRole('administrador')){
            $roles = ['supervisor' => 'Supervisor de oficina', 'revisor' => 'Revisor de pedidos', 'ordenador' => 'Generador del gasto'];
            $organization = Organization::findOrFail(Auth::user()->profile->organization->id);
            $offices = $organization->offices()->get();
            $offices = $offices->pluck('name','id');
        }
        else{
            $roles = ['ordenador' => 'Generador del gasto'];
            $offices = Auth::user()->offices()->get();
            $offices = $offices->pluck('name','id');
        }

        $user_offices = [];
        foreach ($user->offices()->get() as $office) {
            $user_offices[] = $office->id;
        }

        $html = view('customer.users.edit', compact('user', 'roles', 'offices', 'user_roles', 'user_offices'))->render();
        if(Auth::user()->profile->organization->id == $user->profile->organization->id){
            return response()->json(['html' => $html]);  
        }
        else{
            return view('errors.404');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int      $id
     * @param  \Illuminate\Http\Request  $request
     *
     * @return void
     */
    public function update($id, Request $request)
    {
    	$this->validate($request, ['name' => 'required', 'role' => 'required', 'offices' => 'required']);
    	$data = $request->except('password');
    	try {
            $user = User::findOrFail($id);
            if(Auth::user()->profile->organization->id == $user->profile->organization->id){
                $user->update($data);
                $user->profile->active = $request->active;
                $user->profile->save();
                $user->roles()->detach();
                $user->offices()->detach();
                $user->assignRole($request->role);
                foreach ($request->offices as $office) {
                 $user->addUserTo(Office::findOrFail($office));
             }
             Session::flash('alert-success', 'Actualizado con exito!');
         }
         else{
            return view('errors.404');
        }
    } 
    catch (\Illuminate\Database\QueryException $e) {
      Session::flash('alert-danger', 'Error al actualizar en la BD!');
  }
  return redirect('customer/users');
}

public function postChangeUserPass(Request $request) 
{
    $this->validate($request, ['cpassword1' => 'required']);
    try {
        $user = User::findOrFail($request->cpassword_user_id);
        $user->password = bcrypt($request->cpassword1);
        $user->save();
    } catch (\Illuminate\Database\QueryException $e) {
        Session::flash('alert-danger', 'Error en la BD!');
    }
    Session::flash('alert-success', 'Actualizado con exito!');
    if($request->has('from_url')){
        return redirect($request->from_url);
    }
    else{
        return redirect('customer/users');
    }
}
}
