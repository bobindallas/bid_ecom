<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'SiteController@index')->name('home');
Route::resource('site','SiteController');

Route::prefix('admin')->group(function () {

	// standard resource routes
	Route::resource('roles','RolesController');
	Route::resource('permissions','PermissionsController');
	Route::resource('users','UsersController');
	Route::resource('dashboard','DashboardController');
	Route::resource('product_categories','ProductCategoriesController');
	Route::resource('products','ProductsController');
//	Route::resource('product_images','ProductImagesController');
	Route::resource('product_attributes','ProductAttributesController');
//	Route::resource('product_options','ProductOptionsController');
//	Route::resource('product_option_items','ProductOptionItemsController');

	// custom routes
	// Route::get('products/{product}/product_options', 'ProductOptionsController@index')->name('products.product_options');
	// Route::get('products/{product}/create_product_option', 'ProductOptionsController@create')->name('products.create_product_option');
	// Route::get('products/{product}/edit_product_option/{product_option}', 'ProductOptionsController@edit')->name('products.edit_product_option');
	// Route::get('products/{product}/product_option_items/{product_option}', 'ProductOptionItemsController@index')->name('products.product_option_items');

	// Route::get('product_options/{product_option}/create_product_option_item', 'ProductOptionItemsController@create')->name('product_options.create_product_option_item');
	// Route::get('product_options/edit_product_option_item/{product_option_item}', 'ProductOptionItemsController@edit')->name('product_options.edit_product_option_item');
	// Route::put('product_options/{product_option}/update_product_option_item/{product_option_item}', 'ProductOptionItemsController@update')->name('product_options.update_product_option_item');

	Route::get('products/{product}/create_attribute', 'ProductAttributesController@create')->name('products.create_attribute');
	Route::get('products/{product}/edit_attribute/{product_attribute}', 'ProductAttributesController@edit')->name('products.edit_attribute');

	// Product Options
	Route::get('product_options/{product}', 'ProductOptionsController@index')->name('product_options.index');
	Route::get('product_options/{product}/create', 'ProductOptionsController@create')->name('product_options.create');
	Route::post('product_options/{product}/store', 'ProductOptionsController@store')->name('product_options.store');
	Route::get('product_options/{product_option}/edit', 'ProductOptionsController@edit')->name('product_options.edit');
	Route::put('product_options/{product_option}/update', 'ProductOptionsController@update')->name('product_options.update');
	Route::put('product_options/{product_option}/destroy', 'ProductOptionsController@destroy')->name('product_options.destroy');

	// Product Option Items
	Route::get('product_option_items/{product_option}', 'ProductOptionItemsController@index')->name('product_option_items.index');
	Route::get('product_option_items/{product_option}/create', 'ProductOptionItemsController@create')->name('product_option_items.create');
	Route::post('product_option_items/{product_option}/store', 'ProductOptionItemsController@store')->name('product_option_items.store');
	Route::get('product_option_items/{product_option_item}/edit', 'ProductOptionItemsController@edit')->name('product_option_items.edit');
	Route::put('product_option_items/{product_option_item}/update', 'ProductOptionItemsController@update')->name('product_option_items.update');
	Route::put('product_option_items/{product_option_item}/destroy', 'ProductOptionItemsController@destroy')->name('product_option_items.destroy');

	// Product Images
	Route::get('product_images/{product}/index_list','ProductImagesController@index_list')->name('product_images.index_list');
	Route::get('product_images/{product}/index_grid','ProductImagesController@index_grid')->name('product_images.index_grid');
	Route::get('product_images/{product}/create','ProductImagesController@create')->name('product_images.create');
	Route::post('product_images/{product}/store','ProductImagesController@store')->name('product_images.store');
	Route::get('products_images/{product}/edit/{media_id}','ProductImagesController@edit')->name('product_images.edit');
	Route::put('product_images/{product}/update/{media_id}','ProductImagesController@update')->name('product_images.update');
	Route::put('product_images/{product}/update_display_order','ProductImagesController@update_display_order')->name('product_images.update_display_order');

	// Route::get('products/{product}/image_list','ProductsController@image_list')->name('products.image_list');
	// Route::get('products/{product}/image_grid','ProductsController@image_grid')->name('products.image_grid');
	// Route::get('products/{product}/create_image','ProductsController@create_image')->name('products.create_image');
	// Route::post('products/{product}/store_image','ProductsController@store_image')->name('products.store_image');
	// Route::get('products/{product}/edit_image/{media_id}','ProductsController@edit_image')->name('products.edit_image');
	// Route::put('products/{product}/update_image/{media_id}','ProductsController@update_image')->name('products.update_image');
	// Route::put('products/{product}/update_image_display_order','ProductsController@update_image_display_order')->name('products.update_image_display_order');

	Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
});

// Auth::routes(['register' => false]); // hide register link
Auth::routes();
