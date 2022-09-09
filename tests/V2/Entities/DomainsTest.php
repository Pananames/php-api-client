<?php

namespace Pananames\Tests\V2\Entities;

use Exception;
use GuzzleHttp\Psr7\Response;
use Pananames\Api\V2\Entities\Domains;
use Pananames\Api\V2\Response\BaseResponse;
use Pananames\Api\V2\Response\MetaResponse;

class DomainsTest extends ApiEntityTest
{
    public function testList(): void
    {
        $response = new Response(
            200,
            ['Content-Type' => 'application/json; charset=UTF-8'],
            '{"meta":{"current_page":1,"per_page":30,"total_entries":2,"total_pages":1},"data":[{"domain":
            "example.shop","premium":false,"auto_renew":false,"whois_privacy":true,"lock_status":"client",
            "registration_date":"2019-05-11T10:33:25Z","expiration_date":"2025-05-11T23:59:59Z","status":"redemption",
            "name_servers":["dns1.name-services.com","dns2.name-services.com","dns3.name-services.com",
            "dns4.name-services.com","dns5.name-services.com"],"child_name_servers":[]},{"domain":"newexample.paris",
            "premium":false,"auto_renew":false,"whois_privacy":true,"lock_status":"client","registration_date":
            "2021-07-23T07:21:12Z","expiration_date":"2022-07-23T07:21:12Z","deletion_date":"2022-08-31","status":
            "redemption","name_servers":["ns1.pananames.com","ns2.pananames.com","ns3.pananames.com","ns4.pananames.com"
            ],"child_name_servers":[]}]}'
        );

        $result = $this->runAPI(Domains::class, 'getList', [1, 30, 'client', 'redemption'], $response);
        $this->assertInstanceOf(MetaResponse::class, $result);
    }

    public function testInfo(): void
    {
        $response = new Response(
            200,
            ['Content-Type' => 'application/json; charset=UTF-8'],
            '{"data":{"domain":"example.app","premium":false,"auto_renew":false,"whois_privacy":true,"lock_status"
            :"client","registration_date":"2022-01-27T07:36:17Z","expiration_date":"2026-01-27T23:59:59Z","status":"ok",
            "name_servers":["ns1.pananames.com","ns2.pananames.com","ns3.pananames.com","ns4.pananames.com"],
            "child_name_servers":[{"hostname":"api","ipv4":"193.0.3.3"},{"hostname":"ipfor","ipv4":"193.0.1.3"},
            {"hostname":"four","ipv4":"194.0.4.4"}]}}'
        );

        $result = $this->runAPI(Domains::class, 'getInfo', ['example.app'], $response);
        $this->assertInstanceOf(BaseResponse::class, $result);
    }

    public function testCheck(): void
    {
        $response = new Response(
            200,
            ['Content-Type' => 'application/json; charset=UTF-8'],
            '{"data": {"domain": "example.xyz","available": false,"premium": false,"prices": {"currency": "usd",
            "register": 8.18,"renew": 8.18,"transfer": 8.18,"redeem": 58.18},"claim": false,"add_req": false}}'
        );

        $result = $this->runAPI(Domains::class, 'check', ['example.xyz'], $response);
        $this->assertInstanceOf(BaseResponse::class, $result);
    }

    public function testStatusCodes(): void
    {
        $response = new Response(
            200,
            ['Content-Type' => 'application/json; charset=UTF-8'],
            '{"data": ["clientTransferProhibited","renewPeriod"]}'
        );

        $result = $this->runAPI(Domains::class, 'getStatusCodes', ['example.xyz'], $response);
        $this->assertInstanceOf(BaseResponse::class, $result);
    }

    public function testEnableAutoRenew(): void
    {
        $response = new Response(
            200,
            ['Content-Type' => 'application/json; charset=UTF-8'],
            '{"data":{"domain": "example.xyz","auto_renew": true}}'
        );

        $result = $this->runAPI(Domains::class, 'enableAutoRenew', ['example.xyz'], $response);
        $this->assertInstanceOf(BaseResponse::class, $result);
    }

    public function testDisableAutoRenew(): void
    {
        $response = new Response(
            200,
            ['Content-Type' => 'application/json; charset=UTF-8'],
            '{"data":{"domain": "example.xyz","auto_renew": false}}'
        );

        $result = $this->runAPI(Domains::class, 'disableAutoRenew', ['example.xyz'], $response);
        $this->assertInstanceOf(BaseResponse::class, $result);
    }

    public function testInvalidSchema(): void
    {
        $this->expectException(Exception::class);
        $response = new Response(
            200,
            ['Content-Type' => 'application/json; charset=UTF-8'],
            '{"data": [1,"renewPeriod"]}'
        );

        $this->runAPI(Domains::class, 'getStatusCodes', ['example.xyz'], $response);
    }
}
