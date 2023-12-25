<?php
namespace Tests;

use Codeception\Configuration;
use Codeception\Module;
use Codeception\Stub;
use PSpell\Config;
use Tests\Support\ApiTester;

class ApiCest 
{    
    public const USERS_URL = '/users/';

    public function createUser(ApiTester $I)
    {
        $bearerToken = getenv('API_BEARER_TOKEN');
        $I->amBearerAuthenticated($bearerToken);
        $I->sendPost(self::USERS_URL, ['name' => 'username', 'gender' => 'male', 'email' => random_int(0, 100) . '@test.com', 'status' => 'active']);

        $I->seeResponseCodeIs(201);
        $I->seeResponseIsJson();
        $I->seeResponseContains('username');
    }
}