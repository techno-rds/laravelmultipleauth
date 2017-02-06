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
Route::group(['prefix'=>'/','middleware' => 'guest'], function() {
	Route::get('/',array('uses' => 'UsersController@getSignIn'));
    Route::post('/post-login',array('uses' => 'UsersController@postSignIn'));
});
Route::group(['prefix'=>'/','middleware' => 'auth:user'], function(){
    Route::any('/dashboard',array('uses' => 'UsersController@anyDashboard'));
    Route::any('/logout',array('uses' => 'UsersController@anyLogout'));
});

/** Admin Setup**/
Route::group(['prefix'=>'admin','middleware' => 'guest-admin'], function() {
	Route::get('/',array('uses' => 'Admin\AdminController@getSignIn'));
    Route::post('/',array('uses' => 'Admin\AdminController@postSignIn'));
});
Route::group(['prefix'=>'admin','middleware' => 'auth-admin:admin'], function(){
    Route::any('/dashboard',array('uses' => 'Admin\AdminController@anyDashboard'));
    Route::any('/logout',array('uses' => 'Admin\AdminController@anyLogout'));    
});