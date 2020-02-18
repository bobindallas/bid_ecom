<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\ShoppingCart;
use App\Model\Product;
use App\Model\ProductCategory;
use App\Model\Order;
use App\Model\Customer;
use View;

class ShoppingCartController extends Controller {

   public function __construct() {
   
      $this->menu_product_categories = ProductCategory::where('active', 1)->orderBy('display_order', 'asc')->get();
      View::share('menu_product_categories', $this->menu_product_categories);
   }

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index(Request $request) {

      // $request->session()->forget('shopping_cart'); // testing

      $cart_slug  = $request->session()->get('shopping_cart');
      $cart       = ShoppingCart::where('slug', $cart_slug)->first();
      // dd(json_decode($cart->cart_items));die;

      if ($cart) {
         $cart_items = json_decode($cart->cart_items);
      } else {
         $cart_items = '';
      }

      return view('site.shopping_cart')->with([
         'cart'       => $cart,
         'cart_items' => $cart_items
      ]);
	}

	/**
	 * Add item to cart
	 * @return \Illuminate\Http\Response
	 */
	public function add_to_cart(Request $request) {

		// $request->session()->forget('shopping_cart'); // testing 

		if(! $product = Product::with('media')->where('slug', $request->product)->first()) { return abort(404); };

		// this is a hack for now that should be removed later
		if (! $product_category = ProductCategory::where('slug', $request->category)->first()) { return abort(404); };

		// strip all the decision code out - find existing or return a new empty cart
		$cart = $this->haveCart($request);

		if ($cart) {

			// have an existing cart
			$this->updateCart($request, $product, $product_category);

		} else {

			// create new cart
			$this->createCart($request, $product, $product_category);

		}

		// return view('site.shopping_cart');
		return redirect()->route('view_cart');
	}

   /**
    * remove a cart item
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
   public function remove_item(int $id) {

      $cart_slug = session('shopping_cart');

      if ($cart_slug) {

         $cart       = ShoppingCart::where('slug', $cart_slug)->first();
         $cart_items = json_decode($cart->cart_items, true);

         // remove selected item and update the index (if exists)
         array_splice($cart_items,$id, 1);
         $cart_total = 0;
         $item_count = count($cart_items);
         session(['shopping_cart_count' => $item_count]); // items in cart

         if (count($cart_items)){
            $cart_json = json_encode($cart_items);
            foreach($cart_items as $item) {
               $cart_total += $item['item_total'];
            }

         } else {
            $cart_json = '';
         }

         $cart->cart_total = $cart_total;
         $cart->cart_items = $cart_json;
         $cart->item_count = $item_count;
         $cart->save();

       }

      return redirect()->route('view_cart');

   } // remove_item

   /**
    * empty the shopping cart
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
   public function empty_cart() {

      // not sure whether I should kill the cart session and remove the cart record from the DB
      // or just clear the cart - for now we'll just empty the cart

      $cart_slug = session('shopping_cart');

      if ($cart_slug) {

         $cart = ShoppingCart::where('slug', $cart_slug)->first();

         $cart_total = 0;
         $item_count = 0;
         $cart_json  = '';

         $cart->cart_total = $cart_total;
         $cart->cart_items = $cart_json;
         $cart->item_count = $item_count;
         $cart->save();

       }

      session()->forget('shopping_cart_count');
      return redirect()->route('view_cart');

   } // empty_cart

   /**
    * update the shopping cart when add / remove / change items
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
   public function update_cart($id) {
   
   } // update_cart

	/**
	 * find existing or create new shopping cart
	 *
	 * @param \Illuminate\Http\Request $request
	 * @return cart
	 */
	private function haveCart(Request $request) {

		if ($request->session()->has('shopping_cart')) { // add to existing cart}

			$cart_slug = $request->session()->get('shopping_cart');
			$cart      = ShoppingCart::where('slug', $cart_slug)->first();

		} else {

			$cart = null;

		}

		return $cart;

	} // haveCart

   /**
    * add items to existing cart
    *
    * @param  Request $request
    * @param  Product $product
    * @param  Product Category $product_category
    * @return $cart
    */
	private function updateCart(Request $request, $product, $product_category) {

		if ($request->session()->has('shopping_cart')) { // ok

			$cart_slug = $request->session()->get('shopping_cart');
			$cart      = ShoppingCart::where('slug', $cart_slug)->first();

		} else {
			return false;
		}

		// extract cart items
		$cart_items = json_decode($cart->cart_items, true);

		// add this item to cart items
		$cart_item = $this->create_cart_item($request, $product, $product_category);

		$cart_total   = 0;
		$cart_items[] = $cart_item; // add item to cart
		$item_count   = count($cart_items);
		$cart_json    = json_encode($cart_items);
		$request->session()->put('shopping_cart_count', $item_count); // items in cart

		foreach($cart_items as $item) {
			$cart_total += $item['item_total'];
		}

		$cart->cart_items = $cart_json;

		// save cart
		$cart->item_count = $item_count;
		$cart->cart_total = $cart_total;
		$cart->save();

		return $cart;

	} // update_cart

	// add item to new empty cart
	private function createCart(Request $request, $product, $product_category) {

		// create cart item
		$cart_item = $this->create_cart_item($request, $product, $product_category);

		$cart_items      = [];			 // empty cart
		$cart_items[]    = $cart_item; // add item to cart
		$item_count      = count($cart_items);
		$cart_json       = json_encode($cart_items);
		// dd($cart_json);

		$slug = uniqid('', true); // we'll do the quick & dirty here - a lot of other options but are they needed at this point?
		$request->session()->put('shopping_cart', $slug); // store cart id in session
		$request->session()->put('shopping_cart_count', $item_count); // items in cart

		// create new cart
		$cart = new ShoppingCart;

		$cart->slug            = $slug;
		$cart->client_ip       = $request->ip();
		$cart->item_count      = $item_count;
		$cart->cart_total      = $product->price;
		$cart->cart_items      = $cart_json;

		// save cart
		$cart->save();
	}

	/**
	 * create a new shopping cart item
	 *
	 */

	private function create_cart_item(Request $request, $product, $product_category) {
		// dd($product);
		// dd($request);

		// create cart item

		$item_total    = round(($product->price * $request->quantity),2);
		$option_total  = round((1 * $request->quantity),2); // test - need a compute routine for this
		$product_total = round(($item_total + $option_total),2);

		$cart_item = [
			'item_qty'        => $request->quantity,
			'item_total'      => $item_total,
			'option_total'    => $option_total,
			'product_total'   => $product_total,
			'product_id'      => $product->id,
			'category_slug'   => $product_category->slug,
			'product_slug'    => $product->slug,
			'product_name'    => $product->name,
			'product_image'   => $product->media[0]->getUrl(),
			'product_options' => [],
		];

		// load options
		if ($request->options) {
			foreach ($request->options as $k => $v) {
				$cart_item['product_options'][$k] = $v;
			}
		}

		return $cart_item;

	} // create_cart_item

}
