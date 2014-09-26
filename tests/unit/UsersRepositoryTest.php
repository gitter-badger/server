<?php

use PhotoTresor\Repositories\UsersRepository;

class UsersRepositoryTest extends TestCase
{

    private $userModel;
    private $usersRepository;

    public function setUp()
    {
        parent::setUp();

        Mockery::mock('Eloquent');
        $this->userModel = Mockery::mock('User');
        $this->usersRepository = new UsersRepository($this->userModel);
    }

    public function testAll()
    {
        $this->userModel->shouldReceive('get')->once()->withNoArgs()->andReturn($this->userModel);

        $this->usersRepository->all();
    }

}
