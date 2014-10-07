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

    public function testAll()
    {
        $this->model->shouldReceive('get')->once()->withNoArgs()->andReturn($this->model);

        $returned = $this->repository->all();

        $this->assertSame($this->model, $returned);
    }

    public function testAllWithUsers()
    {
        $this->model->shouldReceive('with')->once()->with('User')->andReturn($this->model)
                    ->shouldReceive('get')->once()->withNoArgs()->andReturn($this->model);

        $returned = $this->repository->allWithUsers();

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
        $input = ['file_name' => 'foobar.jpg'];

        $this->model->shouldReceive('create')->once()->with($input)->andReturn($this->model);

        $returned = $this->repository->create($input);

        $this->assertSame($this->model, $returned);
    }

    public function testUpdate()
    {
        $inputs = ['file_name' => 'phototresor.jpg'];
        $this->mockFindOrFail();
        $this->model->shouldReceive('update')->once()->with($inputs)->andReturn($this->model);

        $returned = $this->repository->update(1234, $inputs);

        $this->assertSame($this->model, $returned);
    }

    public function testDelete()
    {
        $this->mockFindOrFail();
        $this->model->shouldReceive('delete')->once()->andReturn(true);

        $returned = $this->repository->delete(1234);

        $this->assertSame(true, $returned);
    }

    private function mockFindOrFail()
    {
        $this->model->shouldReceive('findOrFail')->once()->with(1234)->andReturn($this->model);
    }

}
