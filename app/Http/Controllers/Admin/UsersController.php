<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Role;
use App\User;
use App\Profile;
use Illuminate\Http\Request;
use Session;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return void
     */
    public function index()
    {
        $users = User::All();
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return void
     */
    public function create()
    {
        $roles = Role::select('id', 'name', 'label')->get();
        $roles = $roles->pluck('label', 'name');
        $html = view('admin.users.create', compact('roles'))->render();
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
        $this->validate($request, ['name' => 'required', 'email' => 'required', 'password' => 'required', 'roles' => 'required']);
        $data = $request->except('password');
        $data['password'] = bcrypt($request->password);
        try {
            $user = User::create($data);
            foreach ($request->roles as $role) {
                $user->assignRole($role);
            }
            $profile = new Profile();
            $profile->user_id = $user->id;
            $profile->save();  
            Session::flash('alert-success', 'Creado con exito!');
        } 
        catch (\Illuminate\Database\QueryException $e) {
            Session::flash('alert-danger', 'Error al crear en la BD!');
        }    
        return redirect('admin/users');
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
        $html = view('admin.users.show', compact('user'))->render();
        return response()->json(['html' => $html]);
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
        $roles = Role::select('id', 'name', 'label')->get();
        $roles = $roles->pluck('label', 'name');
        $user = User::with('roles')->select('id', 'name', 'email')->findOrFail($id);
        $user_roles = [];
        foreach ($user->roles as $role) {
            $user_roles[] = $role->name;
        }
        $html = view('admin.users.edit', compact('user', 'roles', 'user_roles'))->render();
        return response()->json(['html' => $html]);
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
        $this->validate($request, ['name' => 'required', 'email' => 'required', 'roles' => 'required']);
        $data = $request->except('password');
        if ($request->has('password')) {
            $data['password'] = bcrypt($request->password);
        }
        try {
            $user = User::findOrFail($id);
            $user->update($data);
            $user->roles()->detach();
            foreach ($request->roles as $role) {
                $user->assignRole($role);
            } 
            Session::flash('alert-success', 'Actualizado con exito!');
        } 
        catch (\Illuminate\Database\QueryException $e) {
            Session::flash('alert-danger', 'Error al actualizar en la BD!');
        }
        return redirect('admin/users');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return void
     */
    public function destroy($id)
    {
        User::destroy($id);
        Session::flash('alert-success', 'Eliminado con exito!');
        return redirect('admin/users');
    }
}
