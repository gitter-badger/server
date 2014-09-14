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
        $I->dontSeeResponseContainsJson(['password' => '$2y$10$kVi0NzY8Bv1oR6uLMuiAI.3Ww9xpzEgQ63zwnu6sH7tQvyTqAFr3O']);
    }
}
