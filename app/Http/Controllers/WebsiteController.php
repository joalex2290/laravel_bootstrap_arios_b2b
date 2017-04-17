<?php

namespace App\Http\Controllers;

use App\Office;
use App\Department;
use App\Category;
use App\product;
use DB;
use Illuminate\Http\Request;

class WebsiteController extends Controller
{
	public function getIndex() {
		$products = Product::orderBy(DB::raw('RAND()'))->take(4)->get();
		return view('index',compact('products'));
	}

	public function getCategoryProducts($name) {
		$category = Category::where('name',$name)->first();
		$products = Product::where('category_id',$category->id)->get();
		return view('products',compact('products'));
	}
	public function getDepartments()
	{
		$departments = Department::All();
		$html = view('auth.departments-select',compact('departments'))->render();
		return response()->json(['html' => $html]);
	}

	public function getDepartmentCities(Request $request)
	{
		if($request->has('office_id'))
		{
			$office = Office::findOrFail($request->office_id);
			$office_city = $office->city_id;
		};
		$department = Department::findOrFail($request->department_id);
		$cities = $department->cities()->pluck('name', 'id');
		$html = view('auth.department-cities-select',compact('cities','office_city'))->render();
		return response()->json(['html' => $html]);
	}
}
