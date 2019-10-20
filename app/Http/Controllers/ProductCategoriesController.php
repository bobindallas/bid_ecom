<?php

namespace App\Http\Controllers;

use App\Model\ProductCategory;
use Illuminate\Http\Request;

class ProductCategoriesController extends Controller {

	
	/**
	 * web auth required
    */
	public function __construct() {
		$this->middleware('auth');
	}

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {

		$this->check_permission('create_product_categories');

      $product_categories = ProductCategory::all();
      return view('admin.product_categories.index', compact('product_categories'));

    } // index

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {

		return view('admin.product_categories.create');

    } // create

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {

		$this->validate($request,[
			'slug'				=> 'bail:required|max:255|alpha_dash|unique:product_categories,slug',
			'name'				=> 'required|max:255',
			'display_order'   => 'required'
		]);

	   $product_category = new ProductCategory;

	   $product_category->slug          = $request->input('slug');
	   $product_category->name          = $request->input('name');
	   $product_category->description   = $request->input('description');
	   $product_category->display_order = $request->input('display_order') || 1;
	   $product_category->active        = $request->input('active') || 0;
	   $product_category->save();

	   return redirect()->route('product_categories.index')->with('success', 'Product Category Saved');

    } // store

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\ProductCategory  $productCategory
     * @return \Illuminate\Http\Response
     */
    public function show(ProductCategory $productCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\ProductCategory  $productCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductCategory $product_category) {

		$this->check_permission('edit_product_categories');
		return view('admin.product_categories.edit', compact('product_category'));

    } // edit

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\ProductCategory  $productCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProductCategory $productCategory) {

		$this->validate($request,[
			// 'slug'				=> 'bail:required|max:255|alpha_dash|unique:product_categories,slug',
			'slug'				=> 'bail:required|max:255|alpha_dash',
			'name'				=> 'required|max:255',
			'display_order'   => 'required'
		]);

		$productCategory->slug          = $request->input('slug');
		$productCategory->name          = $request->input('name');
		$productCategory->description   = $request->input('description');
		$productCategory->display_order = $request->input('display_order');
		$productCategory->active        = $request->input('active') || 0;

		$productCategory->save();

		return redirect()->route('product_categories.index')->with('success', 'Product Category Updated');

    } // update

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\ProductCategory  $productCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductCategory $productCategory)
    {
        //
    }
}
