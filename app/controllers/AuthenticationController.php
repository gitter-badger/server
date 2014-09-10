<?php

class AuthenticationController extends \BaseController {

	/**
	 * Show the login form
	 */
	public function login()
	{
		if(Auth::check())
		{
			return Redirect::action('PhotosController@index');
		}
		return View::make('authentication/login');
	}

	/**
	 * Authenticate the user
	 */
	public function authenticate()
	{
		$user = array(
			'username' => strtolower(Input::get('username')),
			'password' => Input::get('password'),
			'active' => true
		);

		if (Auth::attempt($user)) {
			return Response::apiSuccess(Auth::user());
		}

		return Response::apiError(array('message' => 'Wrong Credentials'));
	}

	/**
	 * User logout
	 */
	public function logout()
	{
		Auth::logout();

		return Redirect::to('/');
	}

}
