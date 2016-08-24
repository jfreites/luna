<?php

// Admin authentication routes
Route::auth();

// Dashboard
Route::get('dashboard', 'DashboardController@dashboard');

// Page Manager
Route::get('page/order', 'PageController@order');
Route::get('page/order_ajax', 'PageController@orderAjax');
Route::post('page/order_ajax', 'PageController@orderAjax');
Route::get('page/get_data', 'PageController@getPages');
Route::resource('page', 'PageController');

// File Manager
Route::get('file-manager', 'FileManagerController@index');
Route::get('file-manager/get_data', 'FileManagerController@getFiles');
Route::get('file-manager/add', 'FileManagerController@create');
Route::post('file-manager', 'FileManagerController@store');
Route::get('file-manager/{resource}/delete', 'FileManagerController@destroy');

// The '/admin' route is not to be used as a page, because it breaks the menu's active state.
Route::get('/', function () {
    return redirect('admin/dashboard');
});
