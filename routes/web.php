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

Route::get('/', 'PageController@showHomePage');
Route::get('/search', 'PageController@showSearchPage')->name('search');

Auth::routes();


Route::resource('/apartaments', 'ApartamentController');
Route::resource('/message', 'MessageController');

  Route::middleware('auth')
    ->prefix('admin')
    ->namespace('Admin')
    ->name('admin.')
    ->group(function(){

      Route::resource('/apt', 'ApartamentController');
      Route::get('/', 'PageController@showAdminHomePage')->name('home');

    });

  // Payment manager route
  Route::middleware('auth')->get('show/{id}/payment', 'PaymentsController@paymentOne')->name('paymentOne');
  Route::post('/checkout', 'PaymentsController@paymentTwo');

  Route::middleware('auth')->get('/show-statistics/{id}', 'ApartamentController@showView')->name('post.show');
