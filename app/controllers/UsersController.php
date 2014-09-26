<?php

use Illuminate\Database\Eloquent\ModelNotFoundException;
use PhotoTresor\Entities\UserEntity;

class UsersController extends \BaseController {

    protected $usersRepository;

    public function __construct(UserEntity $users)
    {
        $this->beforeFilter('auth');
        $this->usersRepository = $users;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $users = $this->usersRepository->all();
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
            return $this->modelNotFoundResponse();
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
        try
        {
            $user = User::findOrFail($id);

            $user->email = Input::get('email');
            $user->username = Input::get('username');
            $user->name_first = Input::get('name_first');
            $user->name_last = Input::get('name_last');
            $user->active = Input::get('active');
            $user->quota = Input::get('quota');

            $user->save();

            return $user;
        }
        catch (ModelNotFoundException $e)
        {
            return $this->modelNotFoundResponse();
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        try
        {
            $user = User::findOrFail($id);
            $user->delete();

            return Response::apiSuccess([]);
        }
        catch (ModelNotFoundException $e)
        {
            return $this->modelNotFoundResponse();
        }
    }

    /**
     * @return mixed
     */
    private function modelNotFoundResponse()
    {
        return Response::apiError(['message' => 'User not found.'], 404);
    }

}

