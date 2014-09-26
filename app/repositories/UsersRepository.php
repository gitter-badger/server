<?php

namespace PhotoTresor\Repositories;

use User;

class UsersRepository {

    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function all()
    {
        return $this->user->get();
    }

} 