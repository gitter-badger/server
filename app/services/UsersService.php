<?php
namespace PhotoTresor\Services;

use PhotoTresor\Repositories\UsersRepository;
use PhotoTresor\Validators\UsersValidator;

class UsersService extends AbstractService {

    /**
     * @var UsersRepository
     */
    protected $repository;

    public function __construct(UsersRepository $userRepository, UsersValidator $userValidator)
    {
        parent::__construct($userRepository, $userValidator);
    }

}
