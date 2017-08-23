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
Route::get('getcities/{keyword}/{lang}', 'GoogleMapController@searchCities');
Route::get('get-city-details/{id}/{lang}', 'GoogleMapController@getCityDetails');
Route::resource('bugreport', 'BugReportController', ['only' => ['store']]);
Route::resource('advertisement.complaint', 'AdvertisementComplaintController', ['only' => ['store']]);
Route::resource('user.complaint', 'UserComplaintController', ['only' => ['store']]);
Route::resource('user.friendship', 'FriendshipController', ['only' => ['store', 'update', 'index', 'show']]);
Route::resource('user', 'UserController', ['only' => ['update', 'show']]);
Route::resource('thread.message', 'MessageController', ['only' => ['store', 'index']]);
Route::resource('user.thread', 'MessageThreadController', ['only' => ['store', 'index']]);


Route::resource('advertisement', 'AdvertisementController', ['only' => ['store', 'index', 'show', 'destroy', 'update']]);

Route::resource('advertisement.comment', 'AdvertisementCommentController', ['only' => ['store']]);
Route::resource('advertisement.status', 'AdvertisementStatusController', ['only' => ['update']]);

Route::get('token', 'Auth\AuthController@refresh');

Route::get('test', 'UserController@test');
