<?php

namespace Pananames\Tests\V2\Entities;

use GuzzleHttp\Psr7\Response;
use Pananames\Api\V2\Entities\Whois;
use Pananames\Api\V2\Response\BaseResponse;

class WhoisTest extends ApiEntityTest
{
    public function testGetWhois(): void
    {
        $response = new Response(
            200,
            ['Content-Type' => 'application/json; charset=UTF-8'],
            '{"data": {"whois_privacy": true,"preview": false,"registrant_contact": {"org": 
            "GLOBAL DOMAIN PRIVACY SERVICES INC","name": "Private Whois","email": "ARARMAX.XYZ@DOMAINS-ANONYMIZER.COM",
            "address": "Tower Financial Center Flr 35,50th St y E. Mendez St","city": "Panama","state": "NA","zip": "NA"
            ,"country": "PA","phone": "+1.4692250522","extras": []},"admin_contact": {"org": 
            "GLOBAL DOMAIN PRIVACY SERVICES INC","name": "Private Whois","email": 
            "ADMIN.ARARMAX.XYZ@DOMAINS-ANONYMIZER.COM","address": "Tower Financial Center Flr 35,50th St y E. Mendez St"
            ,"city": "Panama","state": "NA","zip": "NA","country": "PA","phone": "+1.4692250522","extras": []},
            "tech_contact": {"org": "GLOBAL DOMAIN PRIVACY SERVICES INC","name": "Private Whois","email": 
            "TECH.ARARMAX.XYZ@DOMAINS-ANONYMIZER.COM","address": "Tower Financial Center Flr 35,50th St y E. Mendez St",
            "city": "Panama","state": "NA","zip": "NA","country": "PA","phone": "+1.4692250522","extras": []},
            "billing_contact": {"org": "GLOBAL DOMAIN PRIVACY SERVICES INC","name": "Private Whois","email": 
            "BILL.ARARMAX.XYZ@DOMAINS-ANONYMIZER.COM","address": "Tower Financial Center Flr 35,50th St y E. Mendez St",
            "city": "Panama","state": "NA","zip": "NA","country": "PA","phone": "+1.4692250522","extras": []}}}'
        );

        $result = $this->runAPI(Whois::class, 'getWhois', ['example.com'], $response);
        $this->assertInstanceOf(BaseResponse::class, $result);
    }

    public function testGetWhoisPrivacy(): void
    {
        $response = new Response(
            200,
            ['Content-Type' => 'application/json; charset=UTF-8'],
            '{"data":{"domain": "EXAMPLE.COM","enabled": true}}'
        );

        $result = $this->runAPI(Whois::class, 'getWhoisPrivacy', ['example.com'], $response);
        $this->assertInstanceOf(BaseResponse::class, $result);
    }

    public function testEnableWhoisPrivacy(): void
    {
        $response = new Response(
            200,
            ['Content-Type' => 'application/json; charset=UTF-8'],
            '{"data":{"domain": "example.com","enabled": true}}'
        );

        $result = $this->runAPI(Whois::class, 'enableWhoisPrivacy', ['example.com'], $response);
        $this->assertInstanceOf(BaseResponse::class, $result);
    }

    public function testDisableWhoisPrivacy(): void
    {
        $response = new Response(
            200,
            ['Content-Type' => 'application/json; charset=UTF-8'],
            '{"data":{"domain": "example.com","enabled": false}}'
        );

        $result = $this->runAPI(Whois::class, 'disableWhoisPrivacy', ['example.com'], $response);
        $this->assertInstanceOf(BaseResponse::class, $result);
    }



    public function testInvalidJson(): void
    {
        $this->expectError();
        $response = new Response(
            200,
            ['Content-Type' => 'application/json; charset=UTF-8'],
            '{"data":{"domain": "Wrong JSON}'
        );

        $result = $this->runAPI(Whois::class, 'getWhoisPrivacy', ['example.com'], $response);
        $this->assertInstanceOf(BaseResponse::class, $result);
    }
}
