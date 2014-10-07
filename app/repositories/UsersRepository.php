<?php
namespace PhotoTresor\Repositories;

use User;

class UsersRepository extends AbstractRepository {

    protected $model;

    public function __construct(User $user)
    {
        $this->model = $user;
    }

}
