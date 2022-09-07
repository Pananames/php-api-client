<?php

namespace Pananames\Tests\V2\Entities;


use GuzzleHttp\Psr7\Response;
use Pananames\Api\V2\Entities\Account;
use Pananames\Api\V2\Response\BaseResponse;
use Pananames\Api\V2\Response\MetaResponse;

class AccountTest extends ApiEntityTest
{
    public function testBalance(): void
    {
        $response = new Response(
            200,
            ['Content-Type' => 'application/json; charset=UTF-8'],
            '{"data": { "balance": 98753340.52 } }'
        );

        $result = $this->runAPI(Account::class, 'getBalance', [], $response);
        $this->assertInstanceOf(BaseResponse::class, $result);
    }

    public function testPayments(): void
    {
        $response = new Response(
            200,
            ['Content-Type' => 'application/json; charset=UTF-8'],
            '{"meta": {"current_page": 1,"per_page": 3,"total_entries": 1495,"total_pages": 499},"data": 
                [{"txid": "2373","txdate": "2022-09-06 07:06:25","txtype": "renew","domain": "EXAMPLE.XYZ","period": "1"
                ,"description": "","total": -8.18},{"txid": "2372","txdate": "2022-09-06 07:06:03","txtype": "renew",
                "domain": "EXAMPLE.XYZ","period": "1","description": "","total": -8.18},{"txid": "2371","txdate": 
                "2022-09-05 11:31:40","txtype": "refund","domain": "NEWEXAMPLEFOR.XYZ","period": "","description": "",
                "total": 8.18}]}'
        );

        $result = $this->runAPI(Account::class, 'getPayments', [], $response);
        $this->assertInstanceOf(MetaResponse::class, $result);
    }
}
