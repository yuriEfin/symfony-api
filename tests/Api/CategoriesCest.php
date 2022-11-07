<?php


namespace App\Tests\Api;

use App\Tests\ApiTester;

class CategoriesCest
{
    private const BASE_ROUTE = '/v1/categories';
    
    // tests
    public function tryToTest(ApiTester $I)
    {
        $I->sendGet(self::BASE_ROUTE);
        $I->seeResponseCodeIsSuccessful();
        $I->seeResponseIsJson();
        $I->seeResponseContains('{"limit":20,"offset":0,"totalCount":20,"category":');
    }
}
