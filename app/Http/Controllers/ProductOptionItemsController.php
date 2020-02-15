<?php

namespace App\Http\Controllers;

use App\Model\Product;
use App\Model\ProductOption;
use App\Model\ProductOptionItem;
use Illuminate\Http\Request;

class ProductOptionItemsController extends Controller {

	/**
	* Display a listing of the resource.
	*
	* @return \Illuminate\Http\Response
	*/
	public function index(int $product_option_id) {

		if(! $product_option = ProductOption::with(['product', 'product_option_item'])->where('id', $product_option_id)->first()) { return abort(404); }

		return view('admin.product_option_items.index', compact(
			'product_option'
		));

	} // index

	/**
	* Show the form for creating a new resource.
	*
	* @return \Illuminate\Http\Response
	*/
	public function create(int $product_option_id) {

		if (! $product_option = ProductOption::with(['product'])->where('id', $product_option_id)->first()) { return abort(404); }
		return view('admin.product_option_items.create', compact('product_option'));

	} // create

	/**
	* Store a newly created resource in storage.
	*
	* @param  \Illuminate\Http\Request  $request
	* @return \Illuminate\Http\Response
	*/
	public function store(Request $request) {

		 // FIXME add val & auth
		// dd($request);

		 $product_option_item = new ProductOptionItem();

		 $product_option_item->product_option_id = $request->get('product_option');
		 $product_option_item->slug              = $request->get('slug');
		 $product_option_item->name              = $request->get('name');
		 $product_option_item->value             = $request->get('value');
		 $product_option_item->description       = $request->get('description');
		 $product_option_item->display_order     = ($request->get('display_order')) ? $request->get('display_order') :  1;
		 $product_option_item->active            = $request->get('active') || 0;

		 $product_option_item->save();

		 return redirect()->route('product_option_items.index',
			 ['product' => $request->get('product'), 'product_option' => $request->get('product_option')])
			 ->with('success', 'New Product Option Item Added');

	} // store

	/**
	* Display the specified resource.
	*
	* @param  \App\Model\ProductOptionItem  $productOptionItem
	* @return \Illuminate\Http\Response
	*/
	public function show(ProductOptionItem $productOptionItem)
	{
	   //
	}

	/**
	* Show the form for editing the specified resource.
	*
	* @param  \App\Model\ProductOptionItem  $productOptionItem
	* @return \Illuminate\Http\Response
	*/
	public function edit(int $product_option_item_id) {

		// FIXME val & auth

		if(! $product_option_item = ProductOptionItem::with(['product_option', 'product_option.product'])->find($product_option_item_id)) { return abort(404); }

		return view('admin.product_option_items.edit', compact('product_option_item'));

	}

	/**
	* Update the specified resource in storage.
	*
	* @param  \Illuminate\Http\Request  $request
	* @param  \App\Model\ProductOptionItem  $productOptionItem
	* @return \Illuminate\Http\Response
	*/
	public function update(Request $request, int $product_option_item_id) {

		$product_option_item = ProductOptionItem::with('product_option', 'product_option.product')->findOrFail($product_option_item_id);

		$product_option_item->slug          = $request->get('slug');
		$product_option_item->name          = $request->get('name');
		$product_option_item->description   = $request->get('description');
		$product_option_item->display_order = ($request->get('display_order')) ? $request->get('display_order') : 1;
		$product_option_item->active        = ($request->get('active')) ? $request->get('active') : 0;

		$product_option_item->save();

		return redirect()->route('product_option_items.index', $product_option_item->product_option)->with('success', 'Product Option Item Updated');
	}

	/**
	* Remove the specified resource from storage.
	*
	* @param  \App\Model\ProductOptionItem  $productOptionItem
	* @return \Illuminate\Http\Response
	*/
	public function destroy(ProductOptionItem $productOptionItem)
	{
	   //
	}
}
