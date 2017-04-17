<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Session;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */

    use AuthenticatesUsers;

    //protected $redirectTo = '/shop';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }

    protected function authenticated(Request $request, $user)
    {
        if ( $user->profile['active']||$user->hasRole('superadmin')) {
            if ( $user->hasRole('superadmin') || $user->hasRole('vendedor') ) {
                return redirect('/admin');
            }
            return redirect('/shop');
        }
        else{
            Session::flash('alert-danger', 'El usuario no esta activo, comuniquese con el administrador de su organización.');
            return redirect('/logout');
        }

    }

}