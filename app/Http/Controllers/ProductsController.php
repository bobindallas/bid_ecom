<?php

namespace App\Http\Controllers;

use App\Model\Product;
use App\Model\ProductCategory;
use App\Model\CategoryHasProduct;
use Spatie\MediaLibrary\Models\Media;
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

	} // index

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {

		$product_categories = ProductCategory::all();
		return view('admin.products.create', compact('product_categories'));

	} // create

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
	public function edit($product_id) {

		$product            = Product::with(['category_has_product', 'product_attribute'])->findOrFail($product_id);
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

	/***
	 * add a product image
	 *
	 * @param  \App\Model\Product  $product
	 */
	public function create_image(Product $product) {

		return view('admin.products.image_create', compact('product'));
	
	} // create_image

	/***
	 * edit a product image
	 *
	 * @param  \App\Model\Product  $product
	 */
	public function edit_image(Product $product, $media_id) {

		$product_media = $product->getMedia(config('medialibrary.collections.product_images'));

		// https://github.com/spatie/laravel-medialibrary/issues/1228
		if (! $image = $product_media->where('id', $media_id)->first()) { return abort(404); }

		return view('admin.products.image_edit', compact(
			'product',
			'image'
		));
	
	} // edit_image

	/***
	 * product images - list view
	 *
	 * @param  \App\Model\Product  $product
	 */
	public function image_list($product_id) {

		if (! $product = Product::with('media')->find($product_id)) { return abort(404); };
		
		return view('admin.products.image_list', compact('product')); 

	} // image_list

	/***
	 * product images - grid view
	 *
	 * @param  \App\Model\Product  $product
	 */
	public function image_grid($product_id) {

		if (! $product = Product::with('media')->find($product_id)) { return abort(404); };

		return view('admin.products.image_grid', compact('product'));
	
	} // image_grid

	/***
	 * store a product image
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\Model\Product  $product
	 */
	public function store_image(Request $request, Product $product) {

		if($request->hasFile('image') && $request->file('image')->isValid()){
			$product
				->addMediaFromRequest('image')
				->sanitizingFileName(function($fileName) {
					return strtolower(str_replace(['#', '/', '\\', ' '], '-', $fileName));
				})
				->withCustomProperties([
					'title'   => $request->get('title'),
					'alt_tag' => $request->get('alt_tag'),
					'caption' => $request->get('caption'),
					'active'  => $request->get('active') || 0
				])
				->toMediaCollection(config('medialibrary.collections.product_images'));
		}

		return redirect()->route('products.image_list', $product->id)->with('success', 'New Product Image Added');	

	} // store_image

	/**
	 * update product image
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\Model\Product  $product
	 * @param  int $media_id
	 */
	public function update_image(Request $request, Product $product, $media_id) {

		// FIXME: add validation & auth

		$flash_msg = '';
	
		$product_media = $product->getMedia(config('medialibrary.collections.product_images'));

		// https://github.com/spatie/laravel-medialibrary/issues/1228
		$image = $product_media->where('id', $media_id)->first();

		if ($request->get('product_image_delete')) {
		
			$image->delete();
			$flash_msg = 'Product Image Deleted';

		} else {

			$image->setCustomProperty('title',   $request->get('title'));
			$image->setCustomProperty('alt_tag', $request->get('alt_tag'));
			$image->setCustomProperty('caption', $request->get('caption'));
			$image->setCustomProperty('active',  $request->get('active') || 0);
			$image->save();

			$flash_msg = 'Product Image Updated';
		}

		return redirect()->route('products.image_list', $product->id)->with('success', $flash_msg);	

	} // update_image

	/**
	 *
	 * update product image display order
	 *
	 */

	public function update_image_display_order(Request $request, Product $product) {

		$fu = array_values(json_decode($request->get('item_order'), true));

		Media::setNewOrder($fu);

		return redirect()->route('products.image_list', $product->id)->with('success', 'Product Image Display Order Updated');	
	
	} // update_image_display_order

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Model\Product  $product
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Product $product)
	{
		// not yet...
	}
}
