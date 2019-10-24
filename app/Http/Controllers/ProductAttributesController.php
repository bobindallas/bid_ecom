<?php

namespace App\Http\Controllers;

use App\Model\Product;
use App\Model\ProductAttribute;
use Illuminate\Http\Request;

class ProductAttributesController extends Controller {

	// auth required
	public function __construct() {
		$this->middleware('auth');
	} 

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
	    //
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create(Product $product) {
		return view('admin.product_attributes.create',compact('product'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request) {

		 // FIXME - add validation and auth

		 $product_attribute = new ProductAttribute();

		 $product_attribute->product_id    = $request->get('product');
		 $product_attribute->name          = $request->get('name');
		 $product_attribute->attr_value    = $request->get('attr_value');
		 $product_attribute->display_order = $request->get('display_order') || 1;
		 $product_attribute->active        = $request->get('active') || 1;

		 $product_attribute->save();

		 return redirect()->route('products.edit', $request->get('product'))->with('success', 'Product Attribute Saved');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Model\ProductAttribute  $productAttribute
	 * @return \Illuminate\Http\Response
	 */
	public function show(ProductAttribute $productAttribute)
	{
	    //
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\Model\ProductAttribute  $productAttribute
	 * @return \Illuminate\Http\Response
	 */
	public function edit(Product $product, ProductAttribute $product_attribute) {

		return view('admin.product_attributes.edit',compact(
			'product',
			'product_attribute'
		));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\Model\ProductAttribute  $productAttribute
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, ProductAttribute $product_attribute) {

		// FIXME - add val & auth

		// dd($request);
		// dd($product_attribute);

		$flash_msg = "Product Attribute Updated";

		if ($request->get('product_attribute_delete')) {

			$product_attribute->delete();
			$flash_msg = "Product Attribute Deleted";

		} else {
		
			$product_attribute->name          = $request->get('name');
			$product_attribute->attr_value    = $request->get('attr_value');
			$product_attribute->display_order = $request->get('display_order');
			$product_attribute->active        = $request->get('active');

			$product_attribute->save();

		}

		 return redirect()->route('products.edit', $request->get('product'))->with('success', $flash_msg);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Model\ProductAttribute  $productAttribute
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(ProductAttribute $productAttribute)
	{
	    //
	}
}
