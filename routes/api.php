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

Route::namespace('Api')->group(function() {
    Route::get('/services', 'ApartamentController@getServicesList');
    Route::get('/filtered', 'ApartamentController@filter'); 
    Route::get('/sponsored', 'ApartamentController@returnSponsoredIDs'); 
    Route::get('/statistics/{id}', 'ApartamentController@statistics'); 
});