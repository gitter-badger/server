<?php

use PhotoTresor\Services\PhotosService;

class PhotosServiceTest extends TestCase
{
    private $config;
    private $filesystem;
    private $model;
    private $repository;
    private $service;
    private $validator;

    public function setUp()
    {
        parent::setUp();

        $this->repository = Mockery::mock('PhotoTresor\Repositories\PhotosRepository');
        $this->validator = Mockery::mock('PhotoTresor\Validators\PhotoValidation');
        $this->config = Mockery::mock('Illuminate\Config\Repository');
        $this->filesystem = Mockery::mock('Illuminate\Filesystem\Filesystem');

        $this->service = new PhotosService($this->repository, $this->validator, $this->config, $this->filesystem);

        $this->model = (object) ['user_id' => 1, 'file_sha1' => 'abcdef'];
    }

    public function testDelete()
    {
        $this->repository->shouldReceive('find')->once()->with(1234)->andReturn($this->model);
        $this->config->shouldReceive('get')->once()->with('phototresor.storage')->andReturn('photos/');
        $this->filesystem->shouldReceive('delete')->once()->with('photos/1/abcdef.jpg')->andReturn(true);
        $this->repository->shouldReceive('delete')->once()->with(1234)->andReturn(true);

        $returned = $this->service->delete(1234);

        $this->assertTrue($returned);
    }

    /**
     * @expectedException \Illuminate\Filesystem\FileNotFoundException
     */
    public function testDeleteFileNotFoundException()
    {
        $this->repository->shouldReceive('find')->once()->with(1234)->andReturn($this->model);
        $this->config->shouldReceive('get')->once()->with('phototresor.storage')->andReturn('photos/');
        $this->filesystem->shouldReceive('delete')->once()->with('photos/1/abcdef.jpg')->andReturn(false);

        $this->service->delete(1234);
    }

}

