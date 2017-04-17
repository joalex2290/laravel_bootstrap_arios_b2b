<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Permission;
use App\Role;
use App\User;
use App\Profile;
use App\Catalog;
use App\Office;
use App\Product;
use Illuminate\Http\Request;
use Session;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return void
     */
    public function index()
    {
        return view('index');
    }

    /**
     * Display add permissions to role.
     *
     * @return void
     */
    public function getAddRolePermissions()
    {
        $roles = Role::select('id', 'name')->get();
        return view('admin.permissions.role-add-permissions', compact('roles'));
    }

    public function getRolePermissions(Request $request)
    {
        $role = Role::findOrFail($request->role_id);
        $permissions = Permission::select('id', 'name')->get();
        $html = view('admin.permissions.role-permissions-select',compact('role','permissions'))->render();
        return response()->json(['html' => $html]);
    }

    /**
     * Store add permissions to role.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return void
     */
    public function postAddRolePermissions(Request $request)
    {
        $this->validate($request, ['role' => 'required']);

        $role = Role::findOrFail($request->role);
        $role->permissions()->detach();

        if($request->has('permissions')){
            foreach ($request->permissions as $permission) {
                $permission = Permission::findOrFail($permission);
                $role->addPermissionTo($permission);
            }
        }

        Session::flash('alert-success', 'Agregado con exito!');

        return redirect('admin/add-role-permissions');
    }

    /**
     * Display add users to office.
     *
     * @return void
     */
    public function getAddOfficeUsers()
    {
        $offices = office::select('id', 'name')->get();
        return view('admin.users.office-add-users', compact('offices'));
    }

    public function getOfficeUsers(Request $request)
    {
        $office = Office::findOrFail($request->office_id);
        $users = Profile::Where('organization_id', $office->organization_id)->get();
        $html = view('admin.users.office-users-select',compact('office','users'))->render();
        return response()->json(['html' => $html]);
    }

    public function postAddOfficeUsers(Request $request)
    {
        $this->validate($request, ['office' => 'required']);

        $office = office::findOrFail($request->office);
        $office->users()->detach();

        if($request->has('users')){
            foreach ($request->users as $user) {
                $user = User::findOrFail($user);
                $office->addUser($user);
            }
        }

        Session::flash('alert-success', 'Agregado con exito!');

        return redirect('admin/add-office-users');
    }

    /**
     * Display add offices to catalog.
     *
     * @return void
     */
    public function getAddCatalogOffices()
    {
        $catalogs = Catalog::select('id', 'name')->get();
        return view('admin.office.catalog-add-offices', compact('catalogs'));
    }

    public function getCatalogOffices(Request $request)
    {
        $catalog = Catalog::findOrFail($request->catalog_id);        
        $offices = Office::Where('organization_id', $catalog->organization_id)->get();
        $html = view('admin.office.catalog-offices-select',compact('catalog','offices'))->render();
        return response()->json(['html' => $html]);
    }

    public function postAddCatalogOffices(Request $request)
    {
        $this->validate($request, ['catalog' => 'required']);

        $catalog = Catalog::findOrFail($request->catalog);
        $catalog->offices()->detach();

        if($request->has('offices')){
            foreach ($request->offices as $office) {
                $office = Office::findOrFail($office);
                $catalog->addCatalogTo($office);
            }
        }

        Session::flash('alert-success', 'Agregado con exito!');

        return redirect('admin/add-catalog-offices');
    }

    /**
     * Display add products to catalog.
     *
     * @return void
     */
    public function getAddCatalogProducts()
    {
        $catalogs = Catalog::select('id', 'name')->get();
        $products = Product::select('id', 'name')->get();
        return view('admin.product.catalog-add-products', compact('catalogs','products'));
    }

    public function getCatalogProducts(Request $request)
    {
        $catalog = Catalog::findOrFail($request->catalog_id);
        $html = view('admin.product.catalog-products-table',compact('catalog'))->render();
        return response()->json(['html' => $html]);
    }

    public function postAddCatalogProducts(Request $request)
    {
        $this->validate($request, ['catalog' => 'required']);

        $catalog = Catalog::findOrFail($request->catalog);
        $product = Product::findOrFail($request->product);

        $code = $product->code;
        $name = $product->name;

        if($request->has('code')){
            $code = $request->code;
        }

        if($request->has('name')){
            $name = $request->name;
        }

        try {
            $catalog->addProduct($product,$code, $name, $request->price);
            Session::flash('alert-success', 'Agregado con exito!');
        } 
        catch (\Illuminate\Database\QueryException $e) {
            Session::flash('alert-danger', 'El producto ya pertenece al catalogo!');
        }

        return redirect('admin/add-catalog-products');
    }

    public function postRemoveCatalogProducts(Request $request)
    {
        $catalog = Catalog::findOrFail($request->catalog);
        $catalog->products()->detach($request->product);
        Session::flash('alert-success', 'Removido con exito!');

        return redirect('admin/add-catalog-products');
    }

}
