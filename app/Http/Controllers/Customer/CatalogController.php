<?php

namespace App\Http\Controllers\Customer;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Organization;
use App\Office;
use App\Catalog;
use Illuminate\Http\Request;
use Session;
use Auth;

class CatalogController extends Controller
{
    /**
     * Display add products to catalog.
     *
     * @return void
     */
    public function index(Request $request)
    {
        $organization = Organization::findOrFail(Auth::user()->profile->organization->id);
        $offices = $organization->offices()->get();
        if(Auth::user()->hasRole('administrador')){
            $catalogs = $organization->catalogs()->get();
        }
        else{
            $catalogs = Auth::user()->offices->catalogs;
        }
        return view('customer.catalogs.index', compact('catalogs','offices'));
    }

    public function show($id)
    {
        $catalog = Catalog::findOrFail($id);
        $html = view('customer.catalogs.catalog-products',compact('catalog'))->render();
        return response()->json(['html' => $html]);
    }

    public function postAddCatalogOffices(Request $request)
    {
        $this->validate($request, ['catalog_id' => 'required']);

        $catalog = Catalog::findOrFail($request->catalog_id);
        $catalog->offices()->detach();

        if($request->has('offices')){
            foreach ($request->offices as $office) {
                $office = Office::findOrFail($office);
                $catalog->addOfficeTo($office);
            }
        }

        Session::flash('alert-success', 'Agregado con exito!');

        return redirect('customer/catalogs');
    }
}
