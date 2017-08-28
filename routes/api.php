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
Route::resource('user', 'User\UserController', ['only' => ['update', 'show']]);
Route::resource('user.friendship', 'User\FriendshipController', ['only' => ['store', 'update', 'index', 'show']]);
Route::resource('user.thread', 'Message\MessageThreadController', ['only' => ['store', 'index']]);
Route::resource('thread.message', 'Message\MessageController', ['only' => ['store', 'index']]);
Route::resource('user.complaint', 'User\UserComplaintController', ['only' => ['store','show','index']]);

Route::resource('bugreport', 'BugReportController', ['only' => ['store','show','index']]);

Route::resource('advertisement', 'Advertisement\AdvertisementController', ['only' => ['store', 'index', 'show', 'destroy', 'update']]);
Route::resource('advertisement.status', 'Advertisement\AdvertisementStatusController', ['only' => ['update']]);
Route::resource('advertisement.complaint', 'Advertisement\AdvertisementComplaintController', ['only' => ['store', 'show', 'index']]);
Route::resource('advertisement.comment', 'Advertisement\AdvertisementCommentController', ['only' => ['store']]);

Route::get('token', 'Auth\AuthController@refresh');

Route::get('test', 'User\UserController@test');
