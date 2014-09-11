<?php
use \AcceptanceTester;

class AutheticationCest
{
	public function _before()
	{
	}

	public function _after()
	{
	}

	public function tryToLoginButItFails(AcceptanceTester $I)
	{
		$params = array('username' => 'darthvader', 'password' => 'iamyourfather');
		$I->sendPOST('authenticate', $params);

		$I->seeResponseCodeIs(400);
		$I->seeResponseContainsJson(array('error' => array('message' => 'Wrong Credentials')));
	}

	public function tryToLoginAndSucceed(AcceptanceTester $I)
	{
		$params = array('username' => 'Admin ', 'password' => 'PhotoTresor');
		$I->sendPOST('authenticate', $params);

		$I->seeResponseCodeIs(200);
		$I->seeResponseContainsJson(array('id' => 1));
		$I->seeResponseContainsJson(array('email' => 'admin@PhotoTresor.org'));
		$I->seeResponseContainsJson(array('active' => true));
	}

	public function tryToLogout(AcceptanceTester $I)
	{
		$I->wantTo('logout');

		$I->amOnPage('logout');
		$I->seeCurrentUrlEquals('');
	}

}
