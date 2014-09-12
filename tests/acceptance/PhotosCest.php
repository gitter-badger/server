<?php
use \AcceptanceTester;

class PhotosCest
{
	public static $resourceName = 'photos';

	public function _before()
	{
	}

	public function _after()
	{
	}

	private function authenticate(AcceptanceTester $I)
	{
		$params = array('username' => 'User', 'password' => 'PhotoTresor');
		$I->sendPOST('authenticate', $params);
	}

	public function tryToGetPhotos(AcceptanceTester $I)
	{
		$this->authenticate($I);

		$I->sendGET(self::$resourceName);

		$I->seeResponseCodeIs(200);
		$I->seeResponseContainsJson(array('id' => 1, 'file_name' => '28.jpg'));
		$I->seeResponseContainsJson(array('id' => 2, 'file_name' => 'HPIM1541.JPG'));
		$I->seeResponseContainsJson(array('id' => 3, 'file_name' => 'HPIM2997.JPG'));
		$I->seeResponseContainsJson(array('id' => 4, 'file_name' => 'img_0171.jpg'));
		$I->seeResponseContainsJson(array('id' => 5, 'file_name' => 'p1120151.jpg'));
	}

	public function tryToUploadPhotoWithoutFile(AcceptanceTester $I)
	{
		$this->authenticate($I);

		$I->sendPOST(self::$resourceName);

		$I->seeResponseCodeIs(400);
		$I->seeResponseContainsJson(array('message' => 'No file uploaded.'));
	}

	public function tryToUploadopePhoto(AcceptanceTester $I)
	{
		$this->authenticate($I);

		$I->sendPOST(self::$resourceName, null, array('photo' => __DIR__ . '/../_data/094251.jpg'));

		$photo = array(
			'id' => 6,
			'file_name' => '094251.jpg',
			'file_size' => 1350912,
			'file_mime_type' => 'image/jpeg',
			'file_sha1' => '2d56023c13b9ccf2e4bc086cb9abee7beac12152',
			'width' => 3264,
			'height' => 2448,
			'user_id' => 1,
			'captured_at' => '2014:08:06 09:42:51'
		);

		$I->seeResponseCodeIs(201);
		$I->seeResponseContainsJson($photo);

		$I->seeFileFound('2d56023c13b9ccf2e4bc086cb9abee7beac12152.jpg', __DIR__ . '/../../photos/1');
	}

	public function tryToUploadPhotoTwice(AcceptanceTester $I)
	{
		$this->authenticate($I);

		$I->sendPOST(self::$resourceName, null, array('photo' => __DIR__ . '/../_data/28.jpg'));

		$I->seeResponseCodeIs(409);
		$I->seeResponseContainsJson(array('message' => 'File already exists.'));
	}
}
