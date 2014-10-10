<?php
use \AcceptanceTester;

class PhotosCest
{
	public $resource;

	public function _before(AcceptanceTester $I)
	{
		$this->resource = resource('photos');
        $I->refreshPhotosDirectory($I);
	}

	public function GetPhotos(AcceptanceTester $I)
	{
		$I->authenticate($I);

        $I->sendGET($this->resource);

		$I->seeResponseCodeIs(200);
		$I->seeResponseContainsJson(['id' => 1, 'file_name' => '28.jpg']);
		$I->seeResponseContainsJson(['id' => 2, 'file_name' => 'HPIM1541.JPG']);
		$I->seeResponseContainsJson(['id' => 3, 'file_name' => 'HPIM2997.JPG']);
		$I->seeResponseContainsJson(['id' => 4, 'file_name' => 'img_0171.jpg']);
		$I->seeResponseContainsJson(['id' => 5, 'file_name' => 'p1120151.jpg']);
	}

    /**
     * @param AcceptanceTester $I
     */
    public function GetPhotosExpanedWithUser(AcceptanceTester $I)
    {
        $I->authenticate($I);

        $I->sendGET($this->resource, ['expand' => 'user']);

        $I->seeResponseCodeIs(200);
        $I->seeResponseContainsJson(['id' => 1, 'file_name' => '28.jpg']);
        $I->seeResponseContainsJson(['user' => ['id' => 1, 'username' => 'matthias']]);
    }

	public function UploadPhotoWithoutFile(AcceptanceTester $I)
	{
		$I->authenticate($I);

		$I->sendPOST($this->resource);

		$I->seeResponseCodeIs(400);
		$I->seeResponseContainsJson(['message' => 'No file uploaded.']);
	}

    public function GetPhotoByID(AcceptanceTester $I)
    {
        $I->authenticate($I);

        $I->sendGET($this->resource . '/1');

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

    public function NotGetPhotoByID(AcceptanceTester $I)
    {
        $I->authenticate($I);

        $I->sendGET($this->resource . '/1024');

        $I->seeResponseCodeIs(404);
        $I->seeResponseContainsJson(['error' => ['message' => 'Photo not found.']]);
    }

    public function DeletePhotoByID(AcceptanceTester $I)
    {
        $I->authenticate($I);

        $I->seeInDatabase('photos', ['id' => 1]);
        $I->seeFileFound('tests/_photos/1/c02c99ac35c3b6f9c698ad093dd61148f0f7bce4.jpg');

        $I->sendDELETE($this->resource . '/1');

        $I->seeResponseCodeIs(200);
        $I->dontSeeInDatabase('photos', ['id' => 1]);
        $I->dontSeeFileFound('tests/_photos/1/c02c99ac35c3b6f9c698ad093dd61148f0f7bce4.jpg');
    }

    public function DeleteNonExistingPhotoFromDatabase(AcceptanceTester $I)
    {
        $I->authenticate($I);

        $I->sendDELETE($this->resource . '/1234');

        $I->seeResponseCodeIs(404);
        $I->seeResponseContainsJson(['error' => ['message' => 'Photo not found.']]);
    }

    public function DeleteNonExistingPhotoFromFilesystem(AcceptanceTester $I)
    {
        $I->authenticate($I);

        $I->haveInDatabase('photos', ['id' => 1234, 'user_id' => 1, 'file_sha1' => '6cef2ab8a66easdfa0c8c1c57028afcf7fb77b0d']);

        $I->sendDELETE($this->resource . '/1234');

        $I->seeResponseCodeIs(404);
        $I->seeResponseContainsJson(['error' => ['message' => 'Photo could not be deleted.']]);
    }
}
