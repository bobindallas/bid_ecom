<?php

namespace App\Http\Controllers;

use App\Model\Product;
use App\Model\ProductCategory;
use App\Model\CategoryHasProduct;
use Illuminate\Http\Request;

class ProductsController extends Controller {

	// auth required
	public function __construct() {
		$this->middleware('auth');
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {

		$products = Product::all();
		return view('admin.products.index', compact('products'));

	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {

		$product_categories = ProductCategory::all();
		return view('admin.products.create', compact('product_categories'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request) {

		$this->validate($request,[
			'slug'				=> 'bail:required|max:255|alpha_dash|unique:products,slug',
			'name'				=> 'required|max:255',
			'cost'				=> 'required',
			'cost_multiplier' => 'required'
		]);

		// ddd($request);
		$product = new Product();
		$product->slug            = $request->get('slug');
		$product->name            = $request->get('name');
		$product->description     = $request->get('description');
		$product->cost            = $request->get('cost');
		$product->cost_multiplier = $request->get('cost_multiplier');
		$product->sku             = $request->get('sku');
		$product->active          = $request->get('active') || 0;
		$product->save();

		// product cat(s)
		foreach ($request->product_category as $cat) {

			$pcat = new CategoryHasProduct();

			$pcat->product_category_id = $cat;
			$pcat->product_id          = $product->id;

			$pcat->save();
		
		}

		return redirect()->route('products.index')->with('success', 'Product Saved');

	} // store

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Model\Product  $product
	 * @return \Illuminate\Http\Response
	 */
	public function show(Product $product)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\Model\Product  $product
	 * @return \Illuminate\Http\Response
	 */
	// public function edit(Product $product) {
	public function edit($id) {

		$product            = Product::with(['category_has_product'])->findOrFail($id);
		$product_categories = ProductCategory::all();

		return view('admin.products.edit', compact(
			'product',
		 	'product_categories'
		));

	} // edit

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\Model\Product  $product
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, Product $product) {

		$this->validate($request,[
			// 'slug'				=> 'bail:required|max:255|alpha_dash|unique:products,slug',
			'slug'				=> 'bail:required|max:255|alpha_dash',
			'name'				=> 'required|max:255',
			'cost'				=> 'required',
			'cost_multiplier' => 'required'
		]);

		$product->slug            = $request->get('slug');
		$product->name            = $request->get('name');
		$product->description     = $request->get('description');
		$product->cost            = $request->get('cost');
		$product->cost_multiplier = $request->get('cost_multiplier');
		$product->sku             = $request->get('sku');
		$product->active          = $request->get('active') || 0;
		$product->save();

      // refresh product categories
      CategoryHasProduct::where('product_id', $product->id)->delete(); // clear any existing

		foreach ($request->get('product_category') as $cat) {

			$cp = new CategoryHasProduct();
			$cp->product_id          = $product->id;
			$cp->product_category_id = $cat;
			$cp->save();

		}

		return redirect()->route('products.index')->with('success', 'Product Updated');

	} // update

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Model\Product  $product
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Product $product)
	{
		//
	}
}
