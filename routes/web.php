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

Route::prefix('user')->group(function () {

  Route::get('/equipments/ajax/{filter}', 'EquipmentsController@filterFromAjax')->name('find_equipments_ajax');
  Route::get('/call/{call}/equipments/add', 'CallEquipmentsController@add')->name('equipments_add');

  Route::get('/equipments', 'EquipmentsController@index')->name('equipments');
  Route::get('/warehouses', 'WarehousesController@index')->name('warehouses');
  Route::get('/models', 'ModelsController@index')->name('models');
  Route::get('/statuses', 'StatusController@index')->name('statuses');

  Route::get('/calls', 'CallsController@index')->name('calls');
  Route::get('/calls/create', 'CallsController@create')->name('calls_create');
  Route::post('/calls/store', 'CallsController@store')->name('calls_store');

  Route::get('/call/{call}/equipments/create', 'CallEquipmentsController@create')->name('call_equipments_create');

  Route::get('/call/{id}', 'CallsController@show')->name('call');
  Route::get('/call/success', 'CallsController@renderSuccessView')->name('call_success');
  Route::post('/call/{id}/finish', 'CallsController@execute')->name('call_finish');

  Route::get('/call/{id}/confirmation', 'CallsController@confirmation')->name('call_confirmation');
  Route::post('/call/{id}/confirm', 'CallsController@confirm')->name('call_confirm');

  Route::get('/call/{id}/cancel', 'CallsController@cancel')->name('call_cancel');
  Route::post('/call/{id}/cancel/confirm', 'CallsController@cancelConfirm')->name('call_cancel_confirm');

  Route::get('/calls/entry', 'CallsController@entry')->name('calls_entry');
  Route::get('/call/{id}/entry', 'CallsController@entryConfirm')->name('call_entry');

  Route::post('/call/{id}/entry/screening', 'CallsController@screening')->name('call_entry_screening');
});


Route::prefix('admin')->group(function () {

    Route::get('/equipments/create', 'EquipmentsController@create')->name('equipments_create');
    Route::post('/equipments/store', 'EquipmentsController@store')->name('equipments_store');
    Route::get('/equipment/{id}/edit', 'EquipmentsController@edit')->name('equipment_edit');
    Route::post('/equipment/{id}/update', 'EquipmentsController@update')->name('equipment_update');
    Route::get('/equipment/{id}/descart', 'EquipmentsController@descart')->name('equipment_descart');

    Route::post('/equipment/{id}/back/stock', 'EquipmentsController@backToStock')->name('equipment_back_to_stock');

    Route::get('/warehouses/create', 'WarehousesController@create')->name('warehouses_create');
    Route::post('/warehouses/store', 'WarehousesController@store')->name('warehouses_store');
    Route::get('/warehouse/{id}/edit', 'WarehousesController@edit')->name('warehouses_edit');
    Route::post('/warehouse/{id}/remove', 'WarehousesController@destroy')->name('warehouses_remove');
    Route::post('/warehouse/{id}/update', 'WarehousesController@update')->name('warehouses_update');

    Route::get('/models/create', 'ModelsController@create')->name('models_create');
    Route::post('/model/store', 'ModelsController@store')->name('model_store');
    Route::get('/model/{id}/edit', 'ModelsController@edit')->name('models_edit');
    Route::post('/model/{id}/remove', 'ModelsController@destroy')->name('models_remove');
    Route::post('/model/{id}/update', 'ModelsController@update')->name('models_update');

    Route::get('/statuses/create', 'StatusController@create')->name('status_create');
    Route::post('/statuses/store', 'StatusController@store')->name('status_store');
    Route::get('/statuses/{id}/edit', 'StatusController@edit')->name('status_edit');
    Route::post('/status/{id}/update', 'StatusController@update')->name('status_update');
    Route::post('/statuses/{id}/remove', 'StatusController@destroy')->name('status_remove');

    Route::get('/users', 'UsersController@index')->name('users');
    Route::get('/users/create', 'UsersController@create')->name('users_create');
    Route::post('/users/store', 'UsersController@store')->name('users_store');
    Route::get('/user/{id}/edit', 'UsersController@edit')->name('user_edit');
    Route::post('/user/{id}/update', 'UsersController@update')->name('user_update');
    Route::post('/user/{id}/update-password', 'UsersController@updatePassword')->name('user_update_password');
    Route::post('/user/{id}/remove', 'UsersController@destroy')->name('user_remove');

    Route::get('/call/subjects', 'CallSubjectsController@index')->name('subjects');
    Route::get('/call/subjects/create', 'CallSubjectsController@create')->name('subjects_create');
    Route::post('/call/subjects/store', 'CallSubjectsController@store')->name('subjects_store');

    Route::get('/screenings', 'CallsController@screenings')->name('screenings');

    Route::get('/reports', 'ReportsController@index')->name('reports');
    Route::get('/report/{id}', 'ReportsController@show')->name('report');
    Route::get('/reports/create', 'ReportsController@create')->name('report_create');

    Route::post('/reports/store', 'ReportsController@store')->name('report_store');

    Route::get('/queries/create', 'QueriesController@create')->name('query_create');
    Route::post('/queries/store', 'QueriesController@store')->name('query_store');

    Route::get('/query/{id}/run', 'QueriesController@run')->name('query_run');

    Route::get('/reports/equipments/status/{id}', 'QueriesController@getReportFromStatus')->name('report_equipmennts_from_status');

    Route::get('/reports/equipments/groupingby/{group}', 'QueriesController@getReportGrouping')->name('report_equipmennts_grouping');



});
