<?php
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', ['uses' => 'WebsiteController@getIndex', 'as' => 'index',]);
Route::get('category/{name}', ['uses' => 'WebsiteController@getCategoryProducts', 'as' => 'category.products',]);
Route::get('/about-us', function(){ return view('about-us');});
Route::get('/services', function(){ return view('services');});
Route::get('/contact', function(){ return view('contact');});
Route::post('/contact', ['uses' => 'WebsiteController@postContact']);
Route::post('/search-product', ['uses' => 'WebsiteController@postSearchProduct']);
Route::get('/search-quote', ['uses' => 'WebsiteController@getSearchQuote']);

Auth::routes();
Route::get('/logout', 'Auth\LoginController@logout');
Route::get('register-departments', ['uses' => 'WebsiteController@getDepartments', 'as' => 'register.departments',]);
Route::get('department-cities', ['uses' => 'WebsiteController@getDepartmentCities', 'as' => 'department-cities',]);
Route::get('download/{directory}/{filename}', function($directory, $filename) {
	$file = storage_path().'\\app\\'. $directory.'\\'.$filename;
	return response()->download($file);
});

// Cart Routes
Route::group(['prefix' => 'cart'], function () {
	Route::get('/', ['uses' => 'CartController@getCart', 'as' => 'cart',]);
	Route::get('add', ['uses' => 'CartController@getAddProduct', 'as' => 'cart.add',]);
	Route::post('add-all', ['uses' => 'CartController@getAddAllProducts', 'as' => 'cart.add-all',]);
	Route::get('update', ['uses' => 'CartController@getUpdateProductQty', 'as' => 'cart.update',]);
	Route::get('remove', ['uses' => 'CartController@getRemoveProduct', 'as' => 'cart.remove',]);
	Route::get('destroy', ['uses' => 'CartController@getDestroyCart', 'as' => 'cart.destroy',]);
	Route::get('checkout', ['uses' => 'CartController@getCheckout', 'as' => 'checkout']);
	Route::post('checkout', ['uses' => 'CartController@postCheckout', 'as' => 'checkout']);
	Route::get('quote', ['uses' => 'CartController@getQuote', 'as' => 'quote']);
	Route::post('quote', ['uses' => 'CartController@postQuote', 'as' => 'quote']);
});

// Admin Routes
Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'roles'], 'roles' => ['superadmin', 'vendedor']], function () {
	Route::get('/', ['uses' => 'Admin\AdminController@index', 'as' => 'admin',]);
	Route::get('add-role-permissions', ['uses' => 'Admin\AdminController@getAddRolePermissions', 'as' => 'admin-add-role-permissions',]);
	Route::get('role-permissions', ['uses' => 'Admin\AdminController@getRolePermissions', 'as' => 'admin-role-permissions',]);
	Route::post('add-role-permissions', ['uses' => 'Admin\AdminController@postAddRolePermissions', 'as' => 'admin-add-role-permissions',]);
	Route::resource('roles', 'Admin\RolesController', ['except' => ['destroy']]);
	Route::resource('permissions', 'Admin\PermissionsController', ['except' => ['destroy']]);
	Route::resource('users', 'Admin\UsersController', ['except' => ['destroy']]);
	Route::get('generator', ['uses' => '\Appzcoder\LaravelControllers\ProcessController@getGenerator', 'as' => 'admin-generator',]);
	Route::post('generator', ['uses' => '\Appzcoder\LaravelControllers\ProcessController@postGenerator', 'as' => 'admin-generator',]);
	Route::resource('profile', 'Admin\ProfileController', ['except' => ['destroy']]);
	Route::resource('country', 'Admin\CountryController', ['except' => ['destroy']]);
	Route::resource('department', 'Admin\DepartmentController', ['except' => ['destroy']]);
	Route::resource('city', 'Admin\CityController', ['except' => ['destroy']]);
	Route::resource('category', 'Admin\CategoryController', ['except' => ['destroy']]);
	Route::resource('carrier', 'Admin\CarrierController', ['except' => ['destroy']]);
	Route::resource('organization', 'Admin\OrganizationController', ['except' => ['destroy']]);
	Route::resource('office', 'Admin\OfficeController', ['except' => ['destroy']]);
	Route::get('add-office-users', ['uses' => 'Admin\AdminController@getAddOfficeUsers', 'as' => 'admin-add-office-users',]);
	Route::get('office-users', ['uses' => 'Admin\AdminController@getOfficeUsers', 'as' => 'admin-office-users',]);
	Route::post('add-office-users', ['uses' => 'Admin\AdminController@postAddOfficeUsers', 'as' => 'admin-add-office-users',]);
	Route::resource('product', 'Admin\productController', ['except' => ['destroy']]);
	Route::resource('product', 'Admin\ProductController', ['except' => ['destroy']]);
	Route::resource('catalog', 'Admin\CatalogController', ['except' => ['destroy']]);
	Route::get('add-catalog-offices', ['uses' => 'Admin\AdminController@getAddCatalogOffices', 'as' => 'admin-add-catalog-offices',]);
	Route::get('catalog-offices', ['uses' => 'Admin\AdminController@getCatalogOffices', 'as' => 'admin-catalog-offices',]);
	Route::post('add-catalog-offices', ['uses' => 'Admin\AdminController@postAddCatalogOffices', 'as' => 'admin-add-catalog-products',]);
	Route::get('add-catalog-products', ['uses' => 'Admin\AdminController@getAddCatalogProducts', 'as' => 'admin-add-catalog-products',]);
	Route::get('catalog-products', ['uses' => 'Admin\AdminController@getCatalogProducts', 'as' => 'admin-catalog-products',]);
	Route::post('add-catalog-products', ['uses' => 'Admin\AdminController@postAddCatalogProducts', 'as' => 'admin-add-catalog-products',]);
	Route::post('remove-catalog-products', ['uses' => 'Admin\AdminController@postRemoveCatalogProducts', 'as' => 'admin-remove-catalog-products',]);
	Route::resource('document-number', 'Admin\DocumentNumberController', ['except' => ['destroy']]);
	Route::resource('order', 'Admin\OrderController', ['except' => ['store', 'edit', 'update', 'destroy']]);
	Route::get('manage-orders', ['uses' => 'Shop\OrderController@getAllOrders', 'as' => 'manage-all-orders',]);
	Route::get('manage-orders-details', ['uses' => 'Shop\OrderController@postAllOrderDetails', 'as' => 'manage-order-details',]);
	Route::post('add-order-log', ['uses' => 'Shop\OrderController@postAddOrderLog', 'as' => 'admin.add-order-log',]);
	Route::resource('order-detail', 'Admin\OrderDetailController', ['except' => ['create', 'store', 'edit', 'update', 'destroy']]);
	Route::resource('order-log', 'Admin\OrderLogController', ['except' => ['create', 'store', 'destroy']]);
	Route::get('sap-template', ['uses' => 'Shop\OrderController@getSapTemplate', 'as' => 'admin.sap-template',]);
});

// Shop Routes
Route::group(['namespace' => 'Shop', 'prefix' => 'shop', 'middleware' => ['auth', 'roles'], 'roles' => ['administrador', 'revisor', 'supervisor', 'ordenador']], function () {
	Route::get('/', ['uses' => 'ShopController@index', 'as' => 'shop' ]);
	Route::get('catalogs/', ['uses' => 'ShopController@getCatalog', 'as' => 'shop.catalogs',]);
	Route::get('get-office-catalogs', ['uses' => 'ShopController@getOfficeCatalogs', 'as' => 'shop.get-office-catalogs',]);
	Route::get('set-catalog', ['uses' => 'ShopController@getSetCatalog', 'as' => 'shop.set-catalog',]);
	Route::get('unset-catalog', ['uses' => 'ShopController@getUnsetCatalog', 'as' => 'shop.unset-catalog',]);
	Route::get('catalog/products', ['uses' => 'ShopController@getCatalogProducts', 'as' => 'shop.catalog.products',]);
	Route::get('catalog/product-detail', ['uses' => 'ShopController@getProductDetail', 'as' => 'shop.catalog.product-detail',]);
	// Order routes
	Route::get('my-orders', ['uses' => 'OrderController@getMyOrders', 'as' => 'my-orders',]);
	Route::get('pending-office-orders', ['uses' => 'OrderController@getPendingOfficeOrders', 'as' => 'pending-office-orders',]);
	Route::get('office-orders', ['uses' => 'OrderController@getOfficeOrders', 'as' => 'office-orders',]);
	Route::get('pending-organization-orders', ['uses' => 'OrderController@getPendingOrganizationOrders', 'as' => 'pending-organization-orders',]);
	Route::get('organization-orders', ['uses' => 'OrderController@getOrganizationOrders', 'as' => 'organization-orders',]);
	Route::get('order/detail', ['uses' => 'OrderController@orderDetails', 'as' => 'order.details',]);
	Route::post('order/approve', ['uses' => 'OrderController@approveOrder', 'as' => 'order.approve', ]);
	Route::get('order/reject-order', ['uses' => 'OrderController@rejectOrder', 'as' => 'order.reject', ]);
	Route::post('order/add-customer-log', ['uses' => 'OrderController@postAddCustomerOrderLog', 'as' => 'order.add-customer-log',]);
});

// Customer configurations Routes
Route::group(['namespace' => 'Customer', 'prefix' => 'customer', 'middleware' => ['auth', 'roles'], 'roles' => ['administrador', 'revisor', 'supervisor', 'ordenador']], function () {
	Route::get('/', ['uses' => 'CustomerController@index']);
	Route::resource('organization', 'OrganizationController',['except' => ['index', 'create', 'store','destroy']]);
	Route::resource('offices', 'OfficeController',['except' => 'destroy']);
	Route::resource('users', 'UserController',['except' => 'destroy']);
	Route::post('user/change-pass', ['uses' => 'UserController@postChangeUserPass', 'as' => 'customer.users.change-pass',]);
	Route::resource('profile', 'ProfileController',['except' => ['index', 'create', 'store','destroy']]);
	Route::resource('catalogs', 'CatalogController',['except' => ['create', 'store', 'destroy', 'edit', 'update',]]);
	Route::get('office-users', ['uses' => 'CustomerController@getOfficeUsers', 'as' => 'customer.office-users',]);
	Route::get('add-users-to-office', ['uses' => 'CustomerController@getAddUsersToOffice', 'as' => 'add-users-to-office',]);
	Route::post('add-users-to-office', ['uses' => 'CustomerController@postAddUsersToOffice', 'as' => 'add-users-to-office',]);
	Route::post('remove-user-from-office', ['uses' => 'CustomerController@postRemoveUserFromOffice', 'as' => 'remove-user-from-office',]);
	Route::get('office-catalogs', ['uses' => 'CustomerController@getOfficeCatalogs', 'as' => 'customer.office-catalogs',]);
	Route::get('add-catalogs-to-office', ['uses' => 'CustomerController@getAddCatalogsToOffice', 'as' => 'add-catalogs-to-office',]);
	Route::post('add-catalogs-to-office', ['uses' => 'CustomerController@postAddCatalogsToOffice', 'as' => 'add-catalogs-to-office',]);
	Route::post('remove-catalog-from-office', ['uses' => 'CustomerController@postRemoveCatalogFromOffice', 'as' => 'remove-catalog-from-office',]);
});

//Report Routes
Route::get('reports', ['uses' => 'Customer\ReportController@index', 'as' => 'reports','middleware' => ['auth', 'roles'], 'roles' => ['administrador', 'revisor', 'supervisor']]);
Route::get('report-total-offices-orders', ['uses' => 'Customer\ReportController@totalOfficesOrdersReport', 'as' => 'report1','middleware' => ['auth', 'roles'], 'roles' => ['administrador', 'revisor', 'supervisor']]);
Route::get('report-total-users-orders', ['uses' => 'Customer\ReportController@totalUsersOrdersReport', 'as' => 'report2','middleware' => ['auth', 'roles'], 'roles' => ['administrador', 'revisor', 'supervisor']]);