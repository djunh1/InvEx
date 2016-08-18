<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/



//Route::get('home', 'HomeController@index');
Route::get('home',  array('as' => 'home', 'uses' => 'HomeController@index'));

/* Social media login  */
Route::get('/auth/facebook', 'FacebookAuthController@redirectToProvider');
Route::get('/auth/facebook/callback', 'FacebookAuthController@handleProviderCallback');
Route::get('auth/twitter', 'TwitterAuthController@redirectToProvider');
Route::get('auth/twitter/callback', 'TwitterAuthController@handleProviderCallback');
Route::get('auth/google','GoogleAuthController@redirectToProvider');
Route::get('auth/google/callback', 'GoogleAuthController@handleProviderCallback');

/* Search */
Route::get('/stocks/', 'StockSearchController@index');
Route::post('/stocks/search', 'StockSearchController@searchResults');

/* Stock Results */

Route::get('/stocks/{id}', 'StockDataController@basicResults');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);
