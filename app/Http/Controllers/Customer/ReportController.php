<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;

class ReportController extends Controller
{

	public function __construct() {
		$this->middleware('auth');
	}

	public function index() {
		return view('customer.reports.index');
	}

	public function totalOfficesOrdersReport() {

		$office_orders = DB::table('orders')
		->selectRaw('offices.name as Oficinas, sum(orders.total) as total')
		->join('offices', 'orders.office_id', '=', 'offices.id')
		->where('orders.organization_id', Auth::user()->profile->organization_id)
		->groupBy('offices.name')
		->get();

		$offices = $office_orders->pluck('total', 'Oficinas');
		$data = [];
		foreach ($offices as $key => $value) {
			array_push($data, [$key, $value]);		
		};
		$report = [
		'name' => 'Valor total pedidos por oficina',
		'description' => 'Reporta los totales consolidados por oficina.',
		'chart' => 'PieChart',
		'columns' => [
				['string','Oficina'],
				['number','Total'],
				],
		'data' => $data,
		];

		return view('customer.reports.report',compact('report'));
	}

	public function totalUsersOrdersReport() {

		$user_orders = DB::table('orders')
		->selectRaw('users.name as Usuarios, sum(orders.total) as total')
		->join('users', 'orders.user_id', '=', 'users.id')
		->where('orders.organization_id', Auth::user()->profile->organization_id)
		->groupBy('users.name')
		->get();

		$users = $user_orders->pluck('total', 'Usuarios');
		$data = [];
		foreach ($users as $key => $value) {
			array_push($data, [$key, $value]);		
		};
		$report = [
		'name' => 'Valor total pedidos por usuarios',
		'description' => 'Reporta los totales consolidados por usuarios.',
		'chart' => 'PieChart',
		'columns' => [
				['string','Usuario'],
				['number','Total'],
				],
		'data' => $data,
		];

		return view('customer.reports.report',compact('report'));
	}

}
