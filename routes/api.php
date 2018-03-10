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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::middleware('auth:api')
    ->get('/user', function (Request $request) {
        return $request->user();
    });

Route::group(['middleware' => 'auth:api'], function() {

	Route::get('users', 'UserController@index');
	Route::get('reservations', 'ReservationController@index');
	
	Route::get('services', 'ServiceController@index');
	Route::get('venues', 'VenueController@index');



	Route::get('users/id/{userId}', 'UserController@showId');	//http://localhost:8000/api/users/id/42
	Route::get('users/email/{userEmail}', 'UserController@showEmail');

	Route::get('reservations/{serviceId}/{month}/{year}', 'ReservationController@showReservationMonth');
	Route::get('reservations/{serviceId}', 'ReservationController@showReservationThisMonth');


	Route::get('locations/blocksections/', 'LocationController@showBlockSections');
	Route::get('locations/blocktypes/', 'LocationController@showBlockTypes');
	Route::get('locations/blocks/', 'LocationController@showBlocks');
	Route::get('locations/blocksreservations/', 'LocationController@showBlocksReservations');

	Route::get('locations/lots/', 'LocationController@showLots');
	Route::get('locations/lots/info/{lotId}', 'LocationController@showLot_Info');
	Route::get('locations/lots/{blockId}', 'LocationController@showLots_blockId');
	Route::get('locations/lots/free/{blockId}', 'LocationController@showLots_blockId_free');

	Route::get('locations/sections/', 'LocationController@showSections');



	Route::post('users', 'UserController@store');
	Route::post('feedbacks', 'FeedbackController@store');
	Route::post('reservations', 'ReservationController@store');

	Route::put('users/{userId}', 'UserController@update');
	Route::delete('users/{userId}', 'UserController@delete');





});



Route::post('register', 'Auth\RegisterController@register');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout');

Route::get('users/password/{userEmail}', 'UserController@resetPassword');
Route::get('users/verify/{userEmail}', 'UserController@resendVerifyEmail');



