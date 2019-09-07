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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/search', 'ApartamentController@showSearchPage');

Route::resource('/apartaments', 'ApartamentController');
Route::resource('/message', 'MessageController');

Route::middleware('auth')->prefix('admin')->namespace('Admin')->name('admin.')->group(function(){

  Route::resource('/apt', 'ApartamentController');

});


// rotta di prova
Route::get('/distance', 'ApartamentController@queryApts'); 