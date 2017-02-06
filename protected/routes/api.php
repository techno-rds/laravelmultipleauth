<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('api:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::group(['middleware' => 'guest'], function() {
	Route::post('/post-login',array('uses' => 'Api\UsersController@postSignIn'));
});
Route::group(['middleware' => 'api:api'], function(){
    Route::any('/dashboard',array('uses' => 'Api\UsersController@anyDashboard'));
});
