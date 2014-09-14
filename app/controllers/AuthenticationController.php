<?php

class AuthenticationController extends \BaseController {

	/**
	 * Authenticate the user
	 */
	public function authenticate()
	{
		$user = array(
			'username' => strtolower(trim(Input::get('username'))),
			'password' => Input::get('password'),
			'active' => true
		);

		if (Auth::attempt($user))
			return Response::apiSuccess(Auth::user());

		return Response::apiError(array('message' => 'Wrong Credentials'));
	}

	/**
	 * User logout
	 */
	public function logout()
	{
		Auth::logout();

		return;
	}

}
