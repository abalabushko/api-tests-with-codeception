<?php
namespace Tests;

use Tests\Support\ApiTester;

class ApiCest 
{    
    public const USERS_URL = '/users/';

    public function createUser(ApiTester $I): void
    {
        $bearerToken = getenv('API_BEARER_TOKEN');
        $I->amBearerAuthenticated($bearerToken);
        $I->sendPost(self::USERS_URL,
        [
            'name' => 'username',
            'gender' => 'male',
            'email' => random_int(0, 100) . '@test.com',
            'status' => 'active'
            ]
        );

        $I->seeResponseCodeIs(201);
        $I->seeResponseIsJson();
        $I->seeResponseContains('username');
    }
}
