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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::namespace('Admin')->prefix('v1/admin')->middleware('auth:api')->group(function () {
    
    Route::get('/services', 'ServicesController@apiServices');

});

Route::namespace('Admin')->prefix('admin')->middleware('auth', 'role:admin')->group(function () {

    

});

