<?php
namespace PhotoTresor\Services;

use PhotoTresor\Repositories\UsersRepository;

class UserService extends AbstractService {

    /**
     * @var UsersRepository
     */
    protected $repository;

    public function __construct(UsersRepository $userRepository)
    {
        $this->repository = $userRepository;
    }

}
