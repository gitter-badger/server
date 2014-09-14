<?php
namespace Codeception\Module;

// here you can define custom actions
// all public methods declared in helper class will be available in $I

use AcceptanceTester;

class AcceptanceHelper extends \Codeception\Module
{
    /**
     * @param AcceptanceTester $I
     */
    public function authenticate(AcceptanceTester $I)
    {
        $params = ['username' => 'Matthias', 'password' => 'PhotoTresor'];
        $I->sendPOST(resource('authenticate'), $params);
    }

    protected $photos = ['28.jpg', 'HPIM1541.JPG', 'HPIM2997.JPG', 'img_0171.jpg', 'p1120151.jpg'];
    /*
     * Return the _data path
     */
    private function dataDirectory()
    {
        return __DIR__ . '/../_data/';
    }

    /*
     * Return the _photos path
     */
    private function userPhotoDirectory()
    {
        return __DIR__ . '/../_photos/1/';
    }

    /*
     * Wrapper for copy
     */
    public function copyFile($source, $destination)
    {
        copy($source, $destination);
    }

    /*
     * Wrapper for mkdir
     */
    public function createDirectory($directory)
    {
        mkdir(__DIR__ . $directory);
    }

    /*
     * Delete and then copy all photos
     */
    public function refreshPhotosDirectory(AcceptanceTester $I)
    {
        $I->deleteDir('tests/_photos/');
        $this->createDirectory('/../_photos');
        $this->createDirectory('/../_photos/1');

        foreach($this->photos as $photo)
        {
            $this->copyFile($this->dataDirectory() . $photo, $this->userPhotoDirectory() . sha1_file($this->dataDirectory() . $photo) . '.jpg');
        }
    }

}

