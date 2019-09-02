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
Route::resource('/apartaments', 'ApartamentController');

Route::middleware('auth')->prefix('admin')->namespace('Admin')->name('admin.')->group(function(){
  // Route::get('/userapt', 'ApartamentController@index')->name('index');
  // Route::get('/newapt', 'ApartamentController@create')->name('create');
  // Route::post('/newapt', 'ApartamentController@store')->name('store');

  Route::resource('/apt', 'ApartamentController');

  // Route::post('/savepic', 'ApartamentController@savepic')->name('apt_pic');

});
