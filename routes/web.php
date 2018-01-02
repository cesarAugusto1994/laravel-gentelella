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

Route::get('/equipments/ajax/{filter}', 'EquipmentsController@filterFromAjax')->name('find_equipments_ajax');

Route::get('/call/{call}/equipments/add', 'CallEquipmentsController@add')->name('equipments_add');

Route::get('/equipments', 'EquipmentsController@index')->name('equipments');
Route::get('/brands', 'BrandsController@index')->name('brands');
Route::get('/statuses', 'StatusController@index')->name('statuses');

Route::get('/calls', 'CallsController@index')->name('calls');
Route::get('/calls/create', 'CallsController@create')->name('calls_create');
Route::post('/calls/store', 'CallsController@store')->name('calls_store');

Route::get('/call/{call}/equipments/create', 'CallEquipmentsController@create')->name('call_equipments_create');


Route::prefix('admin')->group(function () {
    
    Route::get('/equipments/create', 'EquipmentsController@create')->name('equipments_create');
    Route::post('/equipments/store', 'EquipmentsController@store')->name('equipments_store');
    Route::get('/equipment/{id}/edit', 'EquipmentsController@edit')->name('equipment_edit');
    Route::post('/equipment/{id}/update', 'EquipmentsController@update')->name('equipment_update');

    Route::get('/brands/create', 'BrandsController@create')->name('brands_create');
    Route::post('/brands/store', 'BrandsController@store')->name('brands_store');
    Route::get('/brand/{id}/edit', 'BrandsController@edit')->name('brands_edit');
    Route::post('/brand/{id}/update', 'BrandsController@update')->name('brands_update');

    Route::get('/statuses/create', 'StatusController@create')->name('status_create');
    Route::post('/statuses/store', 'StatusController@store')->name('status_store');

    Route::get('/users', 'UsersController@index')->name('users');
    Route::get('/users/create', 'UsersController@create')->name('users_create');
    Route::post('/users/store', 'UsersController@store')->name('users_store');
    Route::get('/user/{id}/edit', 'UsersController@edit')->name('user_edit');
    Route::post('/user/{id}/update', 'UsersController@update')->name('user_update');
    Route::post('/user/{id}/update-password', 'UsersController@updatePassword')->name('user_update_password');

    Route::get('/call/subjects', 'CallSubjectsController@index')->name('subjects');
    Route::get('/call/subjects/create', 'CallSubjectsController@create')->name('subjects_create');
    Route::post('/call/subjects/store', 'CallSubjectsController@store')->name('subjects_store');

    
});