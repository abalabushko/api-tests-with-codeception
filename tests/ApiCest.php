<?php
namespace Tests;

use Tests\Support\ApiTester;
use Codeception\Attribute\Incomplete;

class ApiCest 
{    
    #[Incomplete]
    public function tryApi(ApiTester $I)
    {
        $I->sendGet('/');
        $I->seeResponseCodeIs(200);
        $I->seeResponseIsJson();
    }
}