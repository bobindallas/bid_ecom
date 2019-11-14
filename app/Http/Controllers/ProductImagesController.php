<?php

namespace App\Http\Controllers;

use App\Model\Product;
use App\Model\ProductCategory;
use App\Model\CategoryHasProduct;
use Spatie\MediaLibrary\Models\Media;
use Illuminate\Http\Request;

class ProductImagesController extends Controller {

	// auth required
	public function __construct() {
		$this->middleware('auth');
	}

	/***
	 * product images - list view
	 *
	 * @param  \App\Model\Product  $product
	 */
	public function index_list(int $product_id) {

		if (! $product = Product::with('media')->find($product_id)) { return abort(404); };
		
		return view('admin.product_images.index_list', compact('product')); 

	} // image_list

	/***
	 * product images - grid view
	 *
	 * @param  \App\Model\Product  $product
	 */
	public function index_grid(int $product_id) {

		$product = Product::with('media')->findOrFail($product_id);

		return view('admin.product_images.index_grid', compact('product'));
	
	} // image_grid

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

	/***
	 * add a product image
	 *
	 * @param \App\Model\Product $product
	 */
	public function create(Product $product) {

		return view('admin.product_images.create', compact('product'));
	
	} // create_image

	/***
	 * edit a product image
	 *
	 * @param  \App\Model\Product $product
	 */
	public function edit(Product $product, $media_id) {

		$product_media = $product->getMedia(config('medialibrary.collections.product_images'));

		// https://github.com/spatie/laravel-medialibrary/issues/1228
		if (! $image = $product_media->where('id', $media_id)->first()) { return abort(404); }

		return view('admin.product_images.edit', compact('product', 'image'));
	
	} // edit_image

	/***
	 * store a product image
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\Model\Product  $product
	 */
	public function store(Request $request, Product $product) {

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

		return redirect()->route('product_images.index_list', $product->id)->with('success', 'New Product Image Added');	

	} // store_image

	/**
	 * update product image
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\Model\Product  $product
	 * @param  int $media_id
	 */
	public function update(Request $request, Product $product, int $media_id) {

		// FIXME: add validation & auth

		$flash_msg = '';
	
		$product_media = $product->getMedia(config('medialibrary.collections.product_images'));

		// https://github.com/spatie/laravel-medialibrary/issues/1228
		$image = $product_media->where('id', $media_id)->first();

		if ($request->get('product_image_delete')) {
		
			$image->delete();
			$flash_msg = 'Product Image Deleted';

		} else {

			$image->setCustomProperty('title', $request->get('title'));
			$image->setCustomProperty('alt_tag', $request->get('alt_tag'));
			$image->setCustomProperty('caption', $request->get('caption'));
			$image->setCustomProperty('active', $request->get('active') || 0);
			$image->save();

			$flash_msg = 'Product Image Updated';
		}

		return redirect()->route('product_images.index_grid', $product->id)->with('success', $flash_msg);	

	} // update_image

	/**
	 *
	 * update product image display order
	 *
	 */

	public function update_display_order(Request $request, Product $product) {

		$fu = array_values(json_decode($request->get('item_order'), true));

		Media::setNewOrder($fu);

		return redirect()->route('product_images.index_grid', $product->id)->with('success', 'Product Image Display Order Updated');	
	
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
