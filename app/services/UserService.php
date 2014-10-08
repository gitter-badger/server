<?php
namespace PhotoTresor\Services;

use PhotoTresor\Repositories\UsersRepository;
use PhotoTresor\Validators\AbstractValidator;
use PhotoTresor\Validators\UserValidatorLaravel;

class UserService extends AbstractService {

    /**
     * @var UsersRepository
     */
    protected $repository;

    public function __construct(UsersRepository $userRepository, UserValidatorLaravel $validator)
    {
        $this->repository = $userRepository;
        $this->validator = $validator;
    }

}
