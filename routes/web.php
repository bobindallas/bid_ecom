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
	Route::resource('roles','RolesController');
	Route::resource('permissions','PermissionsController');
	Route::resource('users','UsersController');
	Route::resource('dashboard','DashboardController');
	Route::resource('products','ProductsController');
	Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
});

// Auth::routes(['register' => false]); // hide register link
Auth::routes();
