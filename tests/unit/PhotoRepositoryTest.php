<?php

class PhotoRepositoryTest extends TestCase
{

    private $photoMock;
    private $photoRepository;

    public function setUp()
    {
        parent::setUp();

        Mockery::mock('Eloquent');
        $this->photoMock = Mockery::mock('Photo');
        $this->photoRepository = new \PhotoTresor\Repositories\PhotoRepository($this->photoMock);
    }

    public function testExpandUser()
    {
        $this->photoMock->shouldReceive('with')->once()->with('User')->andReturn($this->photoMock);

        $this->photoRepository->expandUser();
    }

    public function testOrder()
    {
        $this->photoMock->shouldReceive('orderBy')->once()->with('captured_at', 'DESC')->andReturn($this->photoMock);

        $this->photoRepository->order();
    }

}
