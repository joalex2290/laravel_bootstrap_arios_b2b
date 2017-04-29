<?php

namespace App\Http\Middleware;

use Closure;
use Session;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // Get the required roles from the route
        $roles = $this->getRequiredRoleForRoute($request->route());
        // Check if a role is required for the route, and
        // if so, ensure that the user has that role.
        $message = "No tiene permisos suficientes para acceder a esta ruta.";
        
        if(!$request->user()->profile['is_active'] && !$request->user()->hasRole('superadmin')){
            $message = "El usuario esta inactivo, comuniquese con el administrador de su organización.";
        }

        foreach ($roles as $role) {
            if ($request->user()->hasRole($role) && ($request->user()->profile['active'] || $request->user()->hasRole('superadmin') )) {
               return $next($request);
           }
       }
       Session::flash('alert-warning', $message);
       return redirect('/');
   }

   private function getRequiredRoleForRoute($route)
   {
    $actions = $route->getAction();

    return isset($actions['roles']) ? $actions['roles'] : null;
}
}
