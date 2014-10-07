<?php

use PhotoTresor\Repositories\PhotoRepository;

class PhotoRepositoryTest extends TestCase
{
    private $model;
    private $repository;

    public function setUp()
    {
        parent::setUp();

        $this->model = Mockery::mock('Photo');
        $this->repository = new PhotoRepository($this->model);
    }

    public function testAllWithUsers()
    {
        $this->model->shouldReceive('with')->once()->with('User')->andReturn($this->model)
                    ->shouldReceive('get')->once()->withNoArgs()->andReturn($this->model);

        $returned = $this->repository->allWithUsers();

        $this->assertSame($this->model, $returned);
    }

}
