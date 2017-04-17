<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Category;
use App\Product;
use Illuminate\Http\Request;
use Session;
use Image;
use File;

class ProductController extends Controller
{
        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
        public function categories()
        {
            $categories = Category::select('id', 'name')->get();
            $categories = $categories->pluck('name', 'id');
            return $categories;
        }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $product = Product::All();
        return view('admin.product.index', compact('product'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $categories = $this->categories();
        $html = view('admin.product.create',compact('categories'))->render();
        return response()->json(['html' => $html]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $this->validate($request, [
         'code' => 'required',
         'name' => 'required',
         'type' => 'required',
         'category_id' => 'required',
         'tax' => 'required',
         'unit_meassure' => 'required'
         ]);
        try {
            $product = Product::create($request->all());
            if ($request->hasFile('img_url')) {
                $file = $request->File('img_url');
                $filename = "product_" . $product->id ."_". time() . "." . $file->getClientOriginalExtension();
                Image::make($file)->fit(300,300)->save(public_path("/img/products/" . $filename ));
                $product->img_url = $filename;
                $product->save();
            }
            Session::flash('alert-success', 'Creado con exito!');
        } 
        catch (\Illuminate\Database\QueryException $e) {
            Session::flash('alert-danger', 'Error al crear en la BD!'.$e);
        }
        return redirect('admin/product');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $product = Product::findOrFail($id);
        $html = view('admin.product.show', compact('product'))->render();
        return response()->json(['html' => $html]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $categories = $this->categories();
        $product = Product::findOrFail($id);
        $product_category = $product->category_id;
        $html = view('admin.product.edit', compact('product','categories','product_category'))->render();
        return response()->json(['html' => $html]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update($id, Request $request)
    {
        $this->validate($request, [
         'code' => 'required',
         'name' => 'required',
         'type' => 'required',
         'category_id' => 'required',
         'tax' => 'required',
         ]);
        try {
            $product = Product::findOrFail($id);
            $current_filename = $product->img_url;
            $product->update($request->all());
            if ($request->hasFile('img_url')) {
                $file = $request->File('img_url');
                $filename = "product_".$id."_". time() . "." . $file->getClientOriginalExtension();

                if($current_filename != "product-default.png" ){
                    File::delete(public_path("/img/products/" .$current_filename ));
                }

                Image::make($file)->fit(300,300)->save(public_path("/img/products/" . $filename ));
                $product->img_url = $filename;
                $product->save();
            }
            Session::flash('alert-success', 'Actualizado con exito!');
        } 
        catch (\Illuminate\Database\QueryException $e) {
            Session::flash('alert-danger', 'Error al actualizar en la BD!');
        }
        return redirect('admin/product');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        Product::destroy($id);
        Session::flash('alert-success', 'Eliminado con exito!');
        return redirect('admin/product');
    }
}
