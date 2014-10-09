<?php

use Illuminate\Database\Eloquent\ModelNotFoundException;
use PhotoTresor\Services\UserService;

/**
 * Class UsersController
 */
class UsersController extends BaseController {

    /**
     * @var UserService
     */
    protected $userService;

    /**
     * @param UserService $userService
     */
    public function __construct(UserService $userService)
    {
        $this->beforeFilter('auth');

        $this->userService = $userService;
    }

    /**
     * Display all users.
     *
     * @return Response
     */
    public function index()
    {
        $users = $this->userService->all();

        return Response::apiSuccess($users);
    }

    /**
     * Create a new user.
     *
     * @return Response
     */
    public function store()
    {
        $user = $this->userService->create(Input::all());

        return Response::apiSuccess($user, 201);
    }

    /**
     * Display the specified user.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        try
        {
            return $this->userService->find($id);
        }
        catch (ModelNotFoundException $e)
        {
            return $this->modelNotFoundResponse();
        }
    }

    /**
     * Update the specified user.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        try
        {
            return $this->userService->update($id, Input::all());
        }
        catch (ModelNotFoundException $e)
        {
            return $this->modelNotFoundResponse();
        }
    }

    /**
     * Remove the specified user.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        try
        {
            $this->userService->delete($id);

            return Response::apiSuccess([]);
        }
        catch (ModelNotFoundException $e)
        {
            return $this->modelNotFoundResponse();
        }
    }

    /**
     * @return \Illuminate\Http\Response
     */
    private function modelNotFoundResponse()
    {
        return Response::apiError(['message' => 'User not found.'], 404);
    }

}

