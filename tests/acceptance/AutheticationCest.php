<?php
use \AcceptanceTester;

class AutheticationCest
{
	public function LoginButItFails(AcceptanceTester $I)
	{
		$params = array('username' => 'darthvader', 'password' => 'iamyourfather');
		$I->sendPOST(resource('authenticate'), $params);

		$I->seeResponseCodeIs(400);
		$I->seeResponseContainsJson(array('error' => array('message' => 'Wrong Credentials')));
	}

	public function LoginAndSucceed(AcceptanceTester $I)
	{
		$I->authenticate($I);

		$I->seeResponseCodeIs(200);
		$I->seeResponseContainsJson(['id' => 1]);
		$I->seeResponseContainsJson(['email' => 'matthias@phototresor.org']);
		$I->seeResponseContainsJson(['active' => true]);
	}

	public function Logout(AcceptanceTester $I)
	{
		$I->sendGET(resource('logout'));

		$I->seeResponseCodeIs(200);
	}

}
