<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Auth::routes();
Route::get('/logout', 'Auth\LoginController@logout');
Route::get('/', 'HomeController@index');

Route::get('/equipments', 'EquipmentsController@index')->name('equipments');
Route::get('/equipments/create', 'EquipmentsController@create')->name('equipments_create');
Route::post('/equipments/store', 'EquipmentsController@store')->name('equipments_store');

Route::get('/brands', 'BrandsController@index')->name('brands');
Route::get('/brands/create', 'BrandsController@create')->name('brands_create');
Route::post('/brands/store', 'BrandsController@store')->name('brands_store');

Route::get('/statuses', 'StatusController@index')->name('statuses');
Route::get('/statuses/create', 'StatusController@create')->name('status_create');
Route::post('/statuses/store', 'StatusController@store')->name('status_store');