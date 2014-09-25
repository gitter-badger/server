<?php

class PhotoRepositoryTest extends TestCase
{

    private $photoModel;
    private $photoRepository;

    public function setUp()
    {
        parent::setUp();

        Mockery::mock('Eloquent');
        $this->photoModel = Mockery::mock('Photo');
        $this->photoRepository = new \PhotoTresor\Repositories\PhotoRepository($this->photoModel);
    }

    public function testAll()
    {
        $this->photoModel->shouldReceive('get')->once()->withNoArgs()->andReturn($this->photoModel);

        $this->photoRepository->all();
    }

    public function testAllWithUsers()
    {
        $this->photoModel->shouldReceive('with')->once()->with('User')->andReturn($this->photoModel)
                        ->shouldReceive('get')->once()->withNoArgs()->andReturn($this->photoModel);

        $this->photoRepository->allWithUsers();
    }

}
