<?php
namespace PhotoTresor\Services;

use Illuminate\Support\MessageBag;
use PhotoTresor\Repositories\UsersRepository;

class UserService extends Service implements ServiceInterface {

    /**
     * @var UsersRepository
     */
    protected $repository;

    public function __construct(UsersRepository $repository)
    {
        $this->repository = $repository;
    }

}