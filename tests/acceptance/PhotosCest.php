<?php
use \AcceptanceTester;

class PhotosCest
{
	public $resourceName = 'photos';

	public function _before(AcceptanceTester $I)
	{
        $I->refreshPhotosDirectory($I);
	}

	public function tryToGetPhotos(AcceptanceTester $I)
	{
		$I->authenticate($I);

        $I->sendGET($this->resourceName);

		$I->seeResponseCodeIs(200);
		$I->seeResponseContainsJson(['id' => 1, 'file_name' => '28.jpg']);
		$I->seeResponseContainsJson(['id' => 2, 'file_name' => 'HPIM1541.JPG']);
		$I->seeResponseContainsJson(['id' => 3, 'file_name' => 'HPIM2997.JPG']);
		$I->seeResponseContainsJson(['id' => 4, 'file_name' => 'img_0171.jpg']);
		$I->seeResponseContainsJson(['id' => 5, 'file_name' => 'p1120151.jpg']);
	}

	public function tryToUploadPhotoWithoutFile(AcceptanceTester $I)
	{
		$I->authenticate($I);

		$I->sendPOST($this->resourceName);

		$I->seeResponseCodeIs(400);
		$I->seeResponseContainsJson(['message' => 'No file uploaded.']);
	}

    public function tryToGetAPhotoByID(AcceptanceTester $I)
    {
        $I->authenticate($I);

        $I->sendGET($this->resourceName . '/1');

        $photo = [
            "id" => 1,
            "file_name" => "28.jpg",
            "file_size" => 41044,
            "file_mime_type" => "image/jpeg",
            "file_sha1" => "c02c99ac35c3b6f9c698ad093dd61148f0f7bce4",
            "width" => 800,
            "height" => 600,
            "user_id" => 1,
            "captured_at" => "2007-08-04 02:22:04"
        ];

        $I->seeResponseCodeIs(200);
        $I->seeResponseContainsJson($photo);
    }

    public function tryToDeletePhotoByID(AcceptanceTester $I)
    {
        $I->authenticate($I);

        $I->seeInDatabase('photos', ['id' => 1]);
        $I->seeFileFound('tests/_photos/1/c02c99ac35c3b6f9c698ad093dd61148f0f7bce4.jpg');

        $I->sendDELETE($this->resourceName . '/1');

        $I->seeResponseCodeIs(200);
        $I->dontSeeInDatabase('photos', ['id' => 1]);
        $I->dontSeeFileFound('tests/_photos/1/c02c99ac35c3b6f9c698ad093dd61148f0f7bce4.jpg');

    }
}
