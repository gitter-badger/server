<?php
namespace PhotoTresor\Entities;

use Illuminate\Support\MessageBag;
use PhotoTresor\Repositories\UsersRepository;

class UserEntity extends Entity implements EntityInterface {

    /**
     * @var UsersRepository
     */
    protected $repository;

    public function __construct(UsersRepository $repository)
    {
        $this->repository = $repository;
    }

}