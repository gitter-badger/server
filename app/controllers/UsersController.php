<?php

use Illuminate\Database\Eloquent\ModelNotFoundException;

class UsersController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$users = User::all();
        return Response::apiSuccess($users);
	}


	/**
	 * Create a new user.
	 *
	 * @return Response
	 */
	public function store()
	{
		$user = User::create(Input::all());
        $user->password = Input::get('password');
        $user->save();

        return Response::apiSuccess($user, 201);
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
        try {
            return User::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return Response::apiError(['message' => 'User not found.'], 404);
        }
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}


}
