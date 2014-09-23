<?php
use \AcceptanceTester;

class UsersCest
{
	protected $resource;

	public function _before()
	{
		$this->resource = resource('users');
	}

	/**
	 * @param AcceptanceTester $I
	 */
	public function GetUsers(AcceptanceTester $I)
	{
		$I->authenticate($I);

		$I->sendGET($this->resource);

		$users = [
			'id' => 1,
			'email' => 'matthias@phototresor.org',
			'username' => 'matthias',
			'name_first' => 'Matthias',
			'name_last' => 'Loibl',
			'active' => true,
			'quota' => 0
		];

		$I->seeResponseCodeIs(200);
		$I->seeResponseContainsJson($users);
		$I->dontSeeResponseContainsJson(['password' => '$2y$10$kVi0NzY8Bv1oR6uLMuiAI.3Ww9xpzEgQ63zwnu6sH7tQvyTqAFr3O']);
	}

	/**
	 * @param AcceptanceTester $I
	 */
	public function CreateNewUser(AcceptanceTester $I)
	{
		$I->authenticate($I);

		$newUser = [
			'email' => 'john@phototresor.org',
			'username' => 'john',
			'password' => 'tr3sor',
			'name_first' => 'John',
			'name_last' => 'Doe',
			'active' => true,
			'quota' => 22147000000 // 2GiB
		];
		$I->sendPOST($this->resource, $newUser);

		$userFields = array_merge($newUser, ['id' => 2]);
		unset($userFields['password']);

		$I->seeResponseCodeIs(201);
		foreach($userFields as $field => $value)
		{
			$I->seeResponseContainsJson([$field => $value]);
		}
		$I->seeInDatabase('users', ['id' => 2]);
	}

	/**
	 * @param AcceptanceTester $I
	 */
	public function GetUserByID(AcceptanceTester $I)
	{
		$I->authenticate($I);

		$I->sendGET($this->resource . '/1');

		$user = [
			'id' => 1,
			'email' => 'matthias@phototresor.org',
			'username' => 'matthias',
			'name_first' => 'Matthias',
			'name_last' => 'Loibl',
			'active' => true,
			'quota' => 0
		];

		$I->seeResponseCodeIs(200);
		$I->seeResponseContainsJson($user);
	}

	/**
	 * @param AcceptanceTester $I
	 */
	public function NotGetUserByID(AcceptanceTester $I)
	{
		$I->authenticate($I);

		$I->sendGET($this->resource . '/23');

		$I->seeResponseCodeIs(404);
		$I->seeErrorMessageIs($I, 'User not found.');
	}

	/**
	 * @param AcceptanceTester $I
	 */
	public function UpdateUser(AcceptanceTester $I)
	{
		$I->authenticate($I);

		$user = [
			'email' => 'somename@phototresor.org',
			'username' => 'someuser',
			'name_first' => 'some',
			'name_last' => 'name',
			'active' => false,
			'quota' => 1048576
		];

		$I->sendPUT($this->resource . '/1', $user);

		$I->seeResponseCodeIs(200);
		$I->seeResponseContainsJson($user);
	}

	public function UpdateNonExistendUser(AcceptanceTester $I)
	{
		$I->authenticate($I);

		$I->sendPUT($this->resource . '/123', ['email' => 'somemail@phototresor.org']);

		$I->seeResponseCodeIs(404);
		$I->seeErrorMessageIs($I, 'User not found.');
	}

	public function DeleteUser(AcceptanceTester $I)
	{
		$I->authenticate($I);

		$I->sendDELETE($this->resource . '/1');

		$I->seeResponseCodeIs(200);
		$I->seeResponseContainsJson([]);
		$I->dontSeeInDatabase('users', ['id' => 1]);
	}

}
