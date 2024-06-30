<?php

declare(strict_types=1);

namespace Tests;

use Codeception\Util\HttpCode;
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

        $I->seeResponseCodeIs(HttpCode::CREATED);
        $I->seeResponseIsJson();
        $I->seeResponseContains('username');
    }

    public function getUser(ApiTester $I): void
    {
        $bearerToken = getenv('API_BEARER_TOKEN');
        $I->amBearerAuthenticated($bearerToken);
        $I->sendGet(self::USERS_URL);

        $I->seeResponseCodeIs(HttpCode::OK);
        $I->seeResponseIsJson();
        $I->seeResponseContains('username');
        $I->seeResponseContains('gender');
    }
}
