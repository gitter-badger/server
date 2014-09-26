<?php

class TestCase extends Illuminate\Foundation\Testing\TestCase {

    public function setUp()
    {
        parent::setUp();

        Mockery::mock('Eloquent');
    }

    public function tearDown()
    {
        parent::tearDown();

        Mockery::close();
    }

    /**
     * Creates the application.
     *
     * @return \Symfony\Component\HttpKernel\HttpKernelInterface
     */
    public function createApplication()
    {
        $unitTesting = true;

        $testEnvironment = 'testing';

        return require __DIR__.'/../../bootstrap/start.php';
    }

}
