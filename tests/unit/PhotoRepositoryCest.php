<?php
use PhotoTresor\Repositories\PhotoRepository;

class PhotoRepositoryCest
{
    protected $photoRepository;

    public function _before()
    {
    }

    public function _after()
    {
    }

    public function tryToTest(UnitTester $I)
    {
        $I->assertTrue(true);
    }
}