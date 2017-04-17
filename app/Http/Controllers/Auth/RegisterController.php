<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Department;
use App\Organization;
use App\Office;
use App\Profile;
use App\DocumentNumber;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Session;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/shop';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
           'tax_id' => 'required|unique:organizations',
           'organization_name' => 'required',
           'address' => 'required',
           'city_id' => 'required',
           'name' => 'required|max:255',
           'email' => 'required|email|max:255|unique:users',
           'password' => 'required|min:6|confirmed',
           ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        try {
            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => bcrypt($data['password']),
                ]);
            $organization = Organization::create([
                'tax_id' => $data['tax_id'],
                'name' => $data['organization_name'],
                'comercial_name' => $data['comercial_name'],
                'phone' => $data['phone'],
                'address' => $data['address'],
                'city_id' => $data['city_id'],
                ]);
            $profile = Profile::create([
                'user_id' => $user->id,
                'organization_id' => $organization->id,
                ]);
            $doc_number = DocumentNumber::create([
                'organization_id' => $organization->id,
                'current_number' => 0,
                'next_number' => 1,
                ]);
            if(empty($data['office_code'])){
                $data['office_code'] = 1;
            }
            if(empty($data['office_name'])){
                $data['office_name'] = 'Sede principal - '.$data['organization_name'];
            }
            $office = Office::create([
                'organization_id' => $organization->id,
                'code' => $data['office_code'],
                'name' => $data['office_name'],
                'type' => 0,
                'contact_name' => $data['contact_name'],
                'contact_phone' => $data['contact_phone'],
                'contact_email' => $data['contact_email'],
                'phone' => $data['phone'],
                'address' => $data['address'],
                'city_id' => $data['city_id'],
                ]);
            $user->assignRole('administrador');
            $user->addUserTo($office);
            Session::flash('alert-success', 'Creado con exito!');
            return $user;
        } 
        catch (\Illuminate\Database\QueryException $e) {
            Session::flash('alert-danger', 'Error al crear en la BD!'.$e);
            return $user;
        }
    }
}
