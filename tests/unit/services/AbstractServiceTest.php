<?php

class AbstractServiceTest extends TestCase
{
    private $repository;
    private $service;
    private $validator;
    private $model;

    public function setUp()
    {
        parent::setUp();

        $this->repository = Mockery::mock('PhotoTresor\Repositories\RepositoryInterface');
        $this->validator = Mockery::mock('PhotoTresor\Validators\ValidatorInterface');
        $this->service = new AbstractServiceDummy($this->repository, $this->validator);

        $this->model = Mockery::mock('Model');
    }

    public function testAll()
    {
        $this->repository->shouldReceive('all')->once()->withNoArgs()->andReturn($this->model);

        $returned = $this->service->all();

        $this->assertSame($this->model, $returned);
    }

    public function testFind()
    {
        $this->repository->shouldReceive('find')->once()->with(1234)->andReturn($this->model);

        $returned = $this->service->find(1234);

        $this->assertSame($this->model, $returned);
    }

    public function testCreate()
    {
        $inputs = ['email' => 'matthias@phototresor.org'];

        $this->validator->shouldReceive('validate')->once()->with($inputs)->andReturn(true);
        $this->repository->shouldReceive('create')->once()->with($inputs)->andReturn($this->model);

        $returned = $this->service->create($inputs);

        $this->assertSame($this->model, $returned);
    }

    public function testUpdate()
    {
        $input = ['email' => 'matthias@phototresor.org'];

        $this->validator->shouldReceive('validate')->once()->with($input)->andReturn(true);
        $this->repository->shouldReceive('update')->once()->with(1234, $input)->andReturn($this->model);

        $returned = $this->service->update(1234, $input);

        $this->assertSame($this->model, $returned);
    }

    public function testDelete()
    {
        $this->repository->shouldReceive('delete')->once()->with(1234)->andReturn(true);

        $returned = $this->service->delete(1234);

        $this->assertSame(true, $returned);
    }

}

class AbstractServiceDummy extends PhotoTresor\Services\AbstractService
{
}