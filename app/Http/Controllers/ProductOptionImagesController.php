<?php

namespace App\Http\Controllers;

use App\Model\ProductOption;
use Spatie\MediaLibrary\Models\Media;
use Illuminate\Http\Request;

class ProductOptionImagesController extends Controller {

	// auth required
	public function __construct() {
		$this->middleware('auth');
	}

	/***
	 * product option images - list view
	 *
	 * @param  \App\Model\ProductOption  $product_option
	 */
	public function index_list(int $product_option_id) {

		if (! $product_option = ProductOption::with(['media', 'product'])->find($product_option_id)) { return abort(404); };
		
		return view('admin.product_option_images.index_list', compact('product_option')); 

	} // image_list

	/***
	 * product option images - grid view
	 *
	 * @param  \App\Model\Product  $product
	 */
	public function index_grid(int $product_option_id) {

		if (! $product_option = ProductOption::with(['product', 'media'])->find($product_option_id)) { return abort(404); };

		return view('admin.product_option_images.index_grid', compact('product_option'));
	
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
	 * add a product option image
	 *
	 * @param \App\Model\Product $product
	 */
	public function create(ProductOption $product_option) {

		return view('admin.product_option_images.create', compact('product_option'));
	
	} // create_image

	/***
	 * edit a product option image
	 *
	 * @param  \App\Model\Product $product
	 */
	public function edit(Request $request, int $product_option_id, int $media_id) {

		// dd($request->header('referer'));
		$product_option = ProductOption::with('product')->findOrFail($product_option_id);
		$product_media  = $product_option->getMedia(config('medialibrary.collections.product_option_images'));

		// https://github.com/spatie/laravel-medialibrary/issues/1228
		if (! $image = $product_media->where('id', $media_id)->first()) { return abort(404); }

		return view('admin.product_option_images.edit', compact(
			'product_option',
			'image'
		));
	
	} // edit_image

	/***
	 * store a product option image
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\Model\Product  $product
	 */
	public function store(Request $request, ProductOption $product_option) {

		if($request->hasFile('image') && $request->file('image')->isValid()){
			$product_option
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
				->toMediaCollection(config('medialibrary.collections.product_option_images'));
		}

		return redirect()->route('product_option_images.index_list', $product_option->id)->with('success', 'New product option image Added');	

	} // store_image

	/**
	 * update product option image
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\Model\Product  $product
	 * @param  int $media_id
	 */
	public function update(Request $request, ProductOption $product_option, int $media_id) {

		// FIXME: add validation & auth

		$flash_msg = '';
	
		$product_media = $product_option->getMedia(config('medialibrary.collections.product_option_images'));

		// https://github.com/spatie/laravel-medialibrary/issues/1228
		$image = $product_media->where('id', $media_id)->first();

		if ($request->get('product_image_delete')) {
		
			$image->delete();
			$flash_msg = 'product option image Deleted';

		} else {

			$image->setCustomProperty('title', $request->get('title'));
			$image->setCustomProperty('alt_tag', $request->get('alt_tag'));
			$image->setCustomProperty('caption', $request->get('caption'));
			$image->setCustomProperty('active', $request->get('active', 0));
			$image->save();

			$flash_msg = 'product option image Updated';
		}

		return redirect()->route('product_option_images.index_grid', $product_option->id)->with('success', $flash_msg);	

	} // update_image

	/**
	 *
	 * update product option image display order
	 *
	 */

	public function update_display_order(Request $request, ProductOption $product_option) {

		$fu = array_values(json_decode($request->get('item_order'), true));

		Media::setNewOrder($fu);

		return redirect()->route('product_option_images.index_list', $product_option->id)->with('success', 'product option image Display Order Updated');	
	
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
