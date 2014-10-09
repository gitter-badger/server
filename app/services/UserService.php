<?php
namespace PhotoTresor\Services;

use PhotoTresor\Repositories\UsersRepository;
use PhotoTresor\Validators\AbstractValidator;
use PhotoTresor\Validators\UserValidator;

class UserService extends AbstractService {

    /**
     * @var UsersRepository
     */
    protected $repository;

    public function __construct(UsersRepository $userRepository, UserValidator $validator)
    {
        $this->repository = $userRepository;
        $this->validator = $validator;
    }

}
