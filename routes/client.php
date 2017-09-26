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

Route::post('/signin', 'AuthController@signIn');
Route::get('/token', 'AuthController@refresh');
//Route::get('/token', function (Request $request) {
//    return $request->headers;
//});

//Route::get('/test1', 'Advertisement\AdvertisementController@index');
