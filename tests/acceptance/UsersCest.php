<?php
use \AcceptanceTester;

class UsersCest
{
    protected $resourceName = 'users';

    public function _before()
    {
    }

    public function _after()
    {
    }

    // tests
    public function tryToGetUsers(AcceptanceTester $I)
    {
        $I->authenticate($I);

        $I->sendGET($this->resourceName);

        $users = [
            'id' => 1,
            'email' => "user@phototresor.org",
            'username' => "user",
            'name_first' => null,
            'name_last' => null,
            'active' => true,
            'quota' => 0
        ];

        $I->seeResponseCodeIs(200);
        $I->seeResponseContainsJson($users);
        $I->dontSeeResponseContainsJson(['password' => '$2y$10$kVi0NzY8Bv1oR6uLMuiAI.3Ww9xpzEgQ63zwnu6sH7tQvyTqAFr3O']);
    }

    public function tryToGetUserByID(AcceptanceTester $I)
    {
        $I->authenticate($I);

        $I->sendGET($this->resourceName . '/1');

        $user = [
            'id' => 1,
            'email' => "user@phototresor.org",
            'username' => "user",
            'name_first' => null,
            'name_last' => null,
            'active' => true,
            'quota' => 0
        ];

        $I->seeResponseCodeIs(200);
        $I->seeResponseContainsJson($user);
    }

    public function tryToNotGetUserByID(AcceptanceTester $I)
    {
        $I->authenticate($I);

        $I->sendGET($this->resourceName . '/23');

        $I->seeResponseCodeIs(404);
        $I->seeResponseContainsJson(['error' => ['message' => 'User not found.']]);
    }
}
