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

Route::resource('advertisement', 'AdvertisementController', ['only' => ['store', 'index', 'show', 'destroy', 'update']]);

Route::resource('advertisement.comment', 'AdvertisementCommentController', ['only' => ['store']]);
Route::resource('advertisement.status', 'AdvertisementStatusController', ['only' => ['update']]);

Route::get('token', 'Auth\AuthController@refresh');

Route::get('test', function () {
    if (\request('to')) {
        return \request('to');
    }
});
