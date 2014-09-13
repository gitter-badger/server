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
}
