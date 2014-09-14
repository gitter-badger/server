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


Route::get('login', array('as' => 'login', 'uses' => 'AuthenticationController@login'));
Route::post('authenticate', array('as' => 'authenticate', 'uses' => 'AuthenticationController@authenticate'));
Route::get('logout', array('as' => 'logout', 'uses' => 'AuthenticationController@logout'));

Route::resource('users', 'UsersController', ['only' => ['index', 'store', 'show', 'update', 'destroy']]);
Route::resource('photos', 'PhotosController', ['only' => ['index', 'store', 'show', 'update', 'destroy']]);

Route::when('photo/*', 'auth');
