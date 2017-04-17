<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Organization;
use App\Office;
use App\Catalog;
use App\User;
use Illuminate\Http\Request;
use Session;
use Auth;

class CustomerController extends Controller
{

    public function getAddCatalogsToOffice()
    {
        $organization = Organization::findOrFail(Auth::user()->profile->organization->id);
        $offices = $organization->offices()->get();
        $catalogs = $organization->catalogs()->get();
        return view('customer.catalogs-office.index', compact('offices','catalogs'));
    }

    public function getOfficeCatalogs(Request $request)
    {
        $office = Office::findOrFail($request->office_id);
        $catalogs = $office->catalogs()->get();
        $html = view('customer.catalogs-office.office-catalogs',compact('office','catalogs'))->render();
        return response()->json(['html' => $html]);
    }

    public function postAddCatalogsToOffice(Request $request)
    {
        $this->validate($request, ['office_id' => 'required']);

        $office = Office::findOrFail($request->office_id);
        $catalog = Catalog::findOrFail($request->catalog_id);

        try {
            $office->addCatalog($catalog);
            Session::flash('alert-success', 'Agregado con exito!');
        } 
        catch (\Illuminate\Database\QueryException $e) {
            Session::flash('alert-danger', 'El catalogo ya pertenece a la oficina!');
        }

        return redirect('customer/add-catalogs-to-office');
    }

    public function postRemoveCatalogFromOffice(Request $request)
    {
        $office = Office::findOrFail($request->office_id);
        $office->catalogs()->detach($request->catalog_id);
        Session::flash('alert-success', 'Removido con exito!');

        return redirect('customer/add-catalogs-to-office');
    }

    public function getAddUsersToOffice()
    {
        $organization = Organization::findOrFail(Auth::user()->profile->organization->id);
        $offices = $organization->offices()->get();
        $users = $organization->profiles()->get();
        return view('customer.users-office.index', compact('offices','users'));
    }

    public function getOfficeUsers(Request $request)
    {
        $office = Office::findOrFail($request->office_id);
        $users = $office->users()->get();
        $html = view('customer.users-office.office-users',compact('users','office'))->render();
        return response()->json(['html' => $html]);
    }

    public function postAddUsersToOffice(Request $request)
    {
        $this->validate($request, ['office_id' => 'required']);

        $office = Office::findOrFail($request->office_id);
        $user = User::findOrFail($request->user_id);

        try {
            $user->addUserTo($office);
            Session::flash('alert-success', 'Agregado con exito!');
        } 
        catch (\Illuminate\Database\QueryException $e) {
            Session::flash('alert-danger', 'El empleado ya pertenece a la oficina!');
        }

        return redirect('customer/add-users-to-office');
    }

    public function postRemoveUserFromOffice(Request $request)
    {
        $office = Office::findOrFail($request->office_id);
        $office->users()->detach($request->user_id);
        Session::flash('alert-success', 'Removido con exito!');

        return redirect('customer/add-users-to-office');
    }

}
