<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::group(array('prefix' => 'api/v1'), function() {

	$RESTful = ['index', 'store', 'show', 'update', 'destroy'];

	Route::post('authenticate', array('as' => 'authenticate', 'uses' => 'AuthenticationController@authenticate'));
	Route::get('logout', array('as' => 'logout', 'uses' => 'AuthenticationController@logout'));

	Route::resource('users', 'UsersController', ['only' => $RESTful]);
	Route::resource('photos', 'PhotosController', ['only' => $RESTful]);

});

# Route Filters
Route::when('photo/*', 'auth');
