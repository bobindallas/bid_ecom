<?php

namespace App\Http\Controllers;

use App\Model\Product;
use App\Model\ProductCategory;
use Illuminate\Http\Request;
use View;

class SiteController extends Controller {

	public function __construct() {
	
		$this->menu_product_categories = ProductCategory::where('active', 1)->orderBy('display_order', 'asc')->get();
		View::share('menu_product_categories', $this->menu_product_categories);
	}


	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {

		$products           = Product::where('active', 1)->with(['product_option','product_option.product_option_item', 'product_attribute', 'media'])->get();
		$product_categories = ProductCategory::where('active', 1)->with(['media'])->orderBy('display_order', 'asc')->get();

		return view('site.index', compact('products', 'product_categories'));

	}

	public function category(string $slug) {

		$product_category = ProductCategory::where('slug', $slug)->with(['category_has_product.product.media'])->firstOrFail();

		return view('site.category', compact('product_category'));
	
	}

	public function product(string $category_slug, $product_slug) {

		$product_category = ProductCategory::where('slug', $category_slug)->firstOrFail();
		$product          = Product::where('slug', $product_slug)->with(['product_option.product_option_item', 'product_attribute', 'media'])->firstOrFail();

		// dd($product);
		// dd($product_category, $product);

		return view('site.product', compact('product_category', 'product'));

	}

} // class
