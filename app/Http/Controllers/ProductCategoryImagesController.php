<?php

namespace App\Http\Controllers;

use App\Model\ProductCategory;
use Spatie\MediaLibrary\Models\Media;
use Illuminate\Http\Request;

class ProductCategoryImagesController extends Controller {

	// auth required
	public function __construct() {
		$this->middleware('auth');
	}

	/***
	 * product category images - list view
	 *
	 * @param  \App\Model\ProductCategory  $product_category
	 */
	public function index_list(int $product_category_id) {

		$product_category = ProductCategory::with(['media'])->findOrFail($product_category_id);
		session(['product_category_image_view'=> 'list']); // for redirect after operation
		return view('admin.product_category_images.index_list', compact('product_category')); 

	} // image_list

	/***
	 * product category images - grid view
	 *
	 * @param  \App\Model\ProductCategory  $product_category
	 */
	public function index_grid(int $product_category_id) {

		$product_category = ProductCategory::with(['media'])->findOrFail($product_category_id);
		session(['product_category_image_view' => 'grid']); // for redirect after operation
		return view('admin.product_category_images.index_grid', compact('product_category'));
	
	} // image_grid

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Model\Product $product
	 * @return \Illuminate\Http\Response
	 */
	public function show(Product $product)
	{
		//
	}

	/***
	 * add a product category image
	 *
	 * @param \App\Model\ProductCategory $product_category
	 */
	public function create(ProductCategory $product_category) {

		return view('admin.product_category_images.create', compact('product_category'));
	
	} // create_image

	/***
	 * edit a product category image
	 *
	 * @param  \App\Model\Product $product
	 */
	public function edit(Request $request, int $product_category_id, int $media_id) {

		$product_category = ProductCategory::findOrFail($product_category_id);
		$product_media  = $product_category->getMedia(config('medialibrary.collections.product_category_images'));

		// https://github.com/spatie/laravel-medialibrary/issues/1228
		if (! $image = $product_media->where('id', $media_id)->first()) { return abort(404); }

		return view('admin.product_category_images.edit', compact(
			'product_category',
			'image'
		));
	
	} // edit_image

	/***
	 * store a product category image
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\Model\Product  $product
	 */
	public function store(Request $request, ProductCategory $product_category) {

		if($request->hasFile('image') && $request->file('image')->isValid()){
			$product_category
				->addMediaFromRequest('image')
				->sanitizingFileName(function($fileName) {
					return strtolower(str_replace(['#', '/', '\\', ' '], '-', $fileName));
				})
				->withCustomProperties([
					'title'   => $request->get('title'),
					'alt_tag' => $request->get('alt_tag'),
					'caption' => $request->get('caption'),
					'active'  => $request->get('active', 0)
				])
				->toMediaCollection(config('medialibrary.collections.product_category_images'));
		}

		$img_view = $request->session()->pull('product_category_image_view');
		if ($img_view  === 'grid') {
			return redirect()->route('product_category_images.index_grid', $product_category->id)->with('success', 'New product category image added');	
		} else {
			return redirect()->route('product_category_images.index_list', $product_category->id)->with('success', 'New product category image added');	
		}

	} // store_image

	/**
	 * update product category image
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\Model\Product  $product
	 * @param  int $media_id
	 */
	public function update(Request $request, ProductCategory $product_category, int $media_id) {

		// FIXME: add validation & auth

		$flash_msg = '';
	
		$product_media = $product_category->getMedia(config('medialibrary.collections.product_category_images'));

		// https://github.com/spatie/laravel-medialibrary/issues/1228
		$image = $product_media->where('id', $media_id)->first();

		if ($request->get('product_category_image_delete')) {
		
			$image->delete();
			$flash_msg = 'Product category image deleted';

		} else {

			$image->setCustomProperty('title', $request->get('title'));
			$image->setCustomProperty('alt_tag', $request->get('alt_tag'));
			$image->setCustomProperty('caption', $request->get('caption'));
			$image->setCustomProperty('active', $request->get('active', 0));
			$image->save();

			$flash_msg = 'Product category image updated';
		}

		$img_view = $request->session()->pull('product_category_image_view');
		if ($img_view  === 'grid') {
			return redirect()->route('product_category_images.index_grid', $product_category->id)->with('success', $flash_msg);	
		} else {
			return redirect()->route('product_category_images.index_list', $product_category->id)->with('success', $flash_msg);	
		}

	} // update_image

	/**
	 *
	 * update product category image display order
	 *
	 */

	public function update_display_order(Request $request, ProductCategory $product_category) {

		$item_order = array_values(json_decode($request->get('item_order'), true));

		Media::setNewOrder($item_order);

		return redirect()->route('product_category_images.index_grid', $product_category->id)->with('success', 'Product category image display order updated');	
	
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
