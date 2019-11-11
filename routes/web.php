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

// Auth::routes(['register' => false]); // hide register link
Auth::routes();

Route::prefix('customer')->group(function () {
});

Route::prefix('admin')->group(function () {

	// standard resource routes
	Route::resource('roles','RolesController');
	Route::resource('permissions','PermissionsController');
	Route::resource('users','UsersController');
	Route::resource('dashboard','DashboardController');
	Route::resource('product_categories','ProductCategoriesController');
	Route::resource('products','ProductsController');
	Route::resource('product_attributes','ProductAttributesController');
	Route::resource('store_details','StoreDetailsController');

	// custom routes
	Route::get('products/{product}/create_attribute', 'ProductAttributesController@create')->name('products.create_attribute');
	Route::get('products/{product}/edit_attribute/{product_attribute}', 'ProductAttributesController@edit')->name('products.edit_attribute');

	// Product Options
	Route::get( 'product_options/{product}', 'ProductOptionsController@index')->name('product_options.index');
	Route::get( 'product_options/{product}/create', 'ProductOptionsController@create')->name('product_options.create');
	Route::post('product_options/{product}/store', 'ProductOptionsController@store')->name('product_options.store');
	Route::get( 'product_options/{product_option}/edit', 'ProductOptionsController@edit')->name('product_options.edit');
	Route::put( 'product_options/{product_option}/update', 'ProductOptionsController@update')->name('product_options.update');
	Route::put( 'product_options/{product_option}/destroy', 'ProductOptionsController@destroy')->name('product_options.destroy');

	// Product Images
	Route::get( 'product_images/{product}/index_list','ProductImagesController@index_list')->name('product_images.index_list');
	Route::get( 'product_images/{product}/index_grid','ProductImagesController@index_grid')->name('product_images.index_grid');
	Route::get( 'product_images/{product}/create','ProductImagesController@create')->name('product_images.create');
	Route::post('product_images/{product}/store','ProductImagesController@store')->name('product_images.store');
	Route::get( 'product_images/{product}/edit/{media_id}','ProductImagesController@edit')->name('product_images.edit');
	Route::put( 'product_images/{product}/update/{media_id}','ProductImagesController@update')->name('product_images.update');
	Route::put( 'product_images/{product}/update_display_order','ProductImagesController@update_display_order')->name('product_images.update_display_order');

	// Product Category Images
	Route::get( 'product_category_images/{product_category}/index_list','ProductCategoryImagesController@index_list')->name('product_category_images.index_list');
	Route::get( 'product_category_images/{product_category}/index_grid','ProductCategoryImagesController@index_grid')->name('product_category_images.index_grid');
	Route::get( 'product_category_images/{product_category}/create', 'ProductCategoryImagesController@create')->name('product_category_images.create');
	Route::post('product_category_images/{product_category}/store', 'ProductCategoryImagesController@store')->name('product_category_images.store');
	Route::get( 'product_category_images/{product_category}/edit/{media_id}', 'ProductCategoryImagesController@edit')->name('product_category_images.edit');
	Route::put( 'product_category_images/{product_category}/update/{media_id}', 'ProductCategoryImagesController@update')->name('product_category_images.update');
	Route::put( 'product_category_images/{product_category}/destroy', 'ProductCategoryImagesController@destroy')->name('product_category_images.destroy');
	Route::put( 'product_category_images/{product_category}/update_display_order','ProductCategoryImagesController@update_display_order')->name('product_category_images.update_display_order');

	// Product Option Images
	Route::get( 'product_option_images/{product_option}/index_list','ProductOptionImagesController@index_list')->name('product_option_images.index_list');
	Route::get( 'product_option_images/{product_option}/index_grid','ProductOptionImagesController@index_grid')->name('product_option_images.index_grid');
	Route::get( 'product_option_images/{product_option}/create', 'ProductOptionImagesController@create')->name('product_option_images.create');
	Route::post('product_option_images/{product_option}/store', 'ProductOptionImagesController@store')->name('product_option_images.store');
	Route::get( 'product_option_images/{product_option}/edit/{media_id}', 'ProductOptionImagesController@edit')->name('product_option_images.edit');
	Route::put( 'product_option_images/{product_option}/update/{media_id}', 'ProductOptionImagesController@update')->name('product_option_images.update');
	Route::put( 'product_option_images/{product_option}/destroy', 'ProductOptionImagesController@destroy')->name('product_option_images.destroy');
	Route::put( 'product_option_images/{product_option}/update_display_order','ProductOptionImagesController@update_display_order')->name('product_option_images.update_display_order');

	// Product Option Item Images
	Route::get( 'product_option_item_images/{product_option_item}/index_list','ProductOptionItemImagesController@index_list')->name('product_option_item_images.index_list');
	Route::get( 'product_option_item_images/{product_option_item}/index_grid','ProductOptionItemImagesController@index_grid')->name('product_option_item_images.index_grid');
	Route::get( 'product_option_item_images/{product_option_item}/create', 'ProductOptionItemImagesController@create')->name('product_option_item_images.create');
	Route::post('product_option_item_images/{product_option_item}/store', 'ProductOptionItemImagesController@store')->name('product_option_item_images.store');
	Route::get( 'product_option_item_images/{product_option_item}/edit/{media_id}', 'ProductOptionItemImagesController@edit')->name('product_option_item_images.edit');
	Route::put( 'product_option_item_images/{product_option_item}/update/{media_id}', 'ProductOptionItemImagesController@update')->name('product_option_item_images.update');
	Route::put( 'product_option_item_images/{product_option_item}/destroy', 'ProductOptionItemImagesController@destroy')->name('product_option_item_images.destroy');
	Route::put( 'product_option_item_images/{product_option_item}/update_display_order','ProductOptionItemImagesController@update_display_order')->name('product_option_item_images.update_display_order');

	// Product Option Items
	Route::get( 'product_option_items/{product_option}', 'ProductOptionItemsController@index')->name('product_option_items.index');
	Route::get( 'product_option_items/{product_option}/create', 'ProductOptionItemsController@create')->name('product_option_items.create');
	Route::post('product_option_items/{product_option}/store', 'ProductOptionItemsController@store')->name('product_option_items.store');
	Route::get( 'product_option_items/{product_option_item}/edit', 'ProductOptionItemsController@edit')->name('product_option_items.edit');
	Route::put( 'product_option_items/{product_option_item}/update', 'ProductOptionItemsController@update')->name('product_option_items.update');
	Route::put( 'product_option_items/{product_option_item}/destroy', 'ProductOptionItemsController@destroy')->name('product_option_items.destroy');

	Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
});

