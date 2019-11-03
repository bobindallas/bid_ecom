<?php

namespace App\Http\Controllers;

use App\Model\Product;
use App\Model\ProductOption;
use Illuminate\Http\Request;

class ProductOptionsController extends Controller {

   // auth required
   public function __construct() {
      $this->middleware('auth');
   }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(int $product_id) {

		 $product = Product::with(['product_option'])->findOrFail($product_id);
		 return view('admin.product_options.index', compact('product'));

    } // index

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Product $product) {

		 return view('admin.product_options.create', compact('product'));

    } // create

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {

		 // FIXME - add val & auth

		// dd($request);

		 $product_option = new ProductOption();

		 $product_option->product_id    = $request->get('product');
		 $product_option->slug          = $request->get('slug');
		 $product_option->name          = $request->get('name');
		 $product_option->description   = $request->get('description');
		 $product_option->display_order = $request->get('display_order') || 1;
		 $product_option->active        = $request->get('active') || 0;

		 $product_option->save();

		 return redirect()->route('product_options.index', $request->get('product'))->with('success', 'Product Option Saved');

    } // store

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\ProductOption  $productOption
     * @return \Illuminate\Http\Response
     */
    public function show(ProductOption $productOption)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\ProductOption  $productOption
     * @return \Illuminate\Http\Response
     */
    public function edit(int $product_option_id) {

		$product_option = ProductOption::with('product')->findOrFail($product_option_id);

		return view('admin.product_options.edit', compact('product_option'));

    } // edit

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\ProductOption  $productOption
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int $product_option_id) {

		 $product_option = ProductOption::with('product')->findOrFail($product_option_id);

		 $product_option->slug          = $request->get('slug');
		 $product_option->name          = $request->get('name');
		 $product_option->description   = $request->get('description');
		 $product_option->display_order = $request->get('display_order');
		 $product_option->active        = $request->get('active') || 0;

		 $product_option->save();

		 return redirect()->route('product_options.index', [
			 'product'        => $product_option->product->id,
			 'product_option' => $product_option->id
		 ])->with('success', 'Product Option Saved');

    } // edit

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\ProductOption  $productOption
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductOption $productOption)
    {
        //
    }

} // class
