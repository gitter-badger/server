<?php

use PhotoTresor\Repositories\UsersRepository;

class UsersRepositoryTest extends TestCase
{
    private $model;
    private $repository;

    public function setUp()
    {
        parent::setUp();

        Mockery::mock('Eloquent');
        $this->model = Mockery::mock('User');
        $this->repository = new UsersRepository($this->model);
    }

    public function testAll()
    {
        $this->model->shouldReceive('get')->once()->withNoArgs()->andReturn($this->model);

        $returned = $this->repository->all();

        $this->assertSame($this->model, $returned);
    }

    public function testFind()
    {
        $this->mockFindOrFail();

        $returned = $this->repository->find(1234);

        $this->assertSame($this->model, $returned);
    }

    public function testCreate()
    {
        $inputs = ['email' => 'matthias@phototresor.org'];

        $this->model->shouldReceive('create')->once()->with($inputs)->andReturn($this->model);

        $returned = $this->repository->create($inputs);

        $this->assertSame($this->model, $returned);
    }

    public function testUpdate()
    {
        $inputs = ['id' => 1234, 'email' => 'matthias@phototresor.org'];

        $this->mockFindOrFail();
        $this->model->shouldReceive('update')->once()->with($inputs)->andReturn($this->model);

        $returned = $this->repository->update($inputs);

        $this->assertSame($this->model, $returned);
    }

    public function testDelete()
    {
        $this->mockFindOrFail();
        $this->model->shouldReceive('delete')->once()->withNoArgs()->andReturn($this->model);

        $returned = $this->repository->delete(1234);

        $this->assertSame($this->model, $returned);
    }

    private function mockFindOrFail()
    {
        $this->model->shouldReceive('findOrFail')->once()->with(1234)->andReturn($this->model);
    }

}
