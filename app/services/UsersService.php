<?php
namespace PhotoTresor\Services;

use PhotoTresor\Repositories\UsersRepository;
use PhotoTresor\Validators\UserValidation;

class UsersService extends AbstractService {

    /**
     * @var UsersRepository
     */
    protected $repository;

    public function __construct(UsersRepository $userRepository, UserValidation $userValidator)
    {
        parent::__construct($userRepository, $userValidator);
    }

}
