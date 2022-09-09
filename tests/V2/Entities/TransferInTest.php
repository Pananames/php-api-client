<?php

namespace Pananames\Tests\V2\Entities;

use GuzzleHttp\Psr7\Response;
use Pananames\Api\V2\Entities\TransferIn;
use Pananames\Api\V2\Response\MetaResponse;

class TransferInTest extends ApiEntityTest
{
    public function testTransfersList(): void
    {
        $response = new Response(
            200,
            ['Content-Type' => 'application/json; charset=UTF-8'],
            '{"meta": {"current_page": 1,"per_page": 30,"total_entries": 2,"total_pages": 1},"data": [{"domain": 
            "example.com","transfer_status": "waiting registrant confirmation","premium_price": 0,"whois_privacy": true,
            "registrant_contact": {"org": "Fozzy","name": "Logika","email": "qwingt@gmail.com","address": 
            "ul. Rhylova 8","city": "Poling","state": "LV","zip": "75333","country": "DE","phone": "+1.9175313444",
            "extras": ""},"admin_contact": {"org": "Fozzy","name": "Logika","email": "qwingt@gmail.com","address": 
            "ul. Rhylova 8","city": "Poling","state": "LV","zip": "75333","country": "DE","phone": "+1.9175313444",
            "extras": ""},"tech_contact": {"org": "Fozzy","name": "Logika","email": "qwingt@gmail.com","address": 
            "ul. Rhylova 8","city": "Poling","state": "LV","zip": "75333","country": "DE","phone": "+1.9175313444",
            "extras": ""},"billing_contact": {"org": "Fozzy","name": "Logika","email": "qwingt@gmail.com","address": 
            "ul. Rhylova 8","city": "Poling","state": "LV","zip": "75333","country": "DE","phone": "+1.9175313444",
            "extras": ""}},{"domain": "examplene.com","transfer_status": "waiting registrant confirmation",
            "premium_price": 0,"whois_privacy": true,"registrant_contact": {"org": "Fozzy","name": "Logika","email": 
            "qwingt@gmail.com","address": "ul. Rhylova 8","city": "Poling","state": "LV","zip": "75333","country": "",
            "phone": "+1.9175313444","extras": ""},"admin_contact": {"org": "Fozzy","name": "Logika","email": 
            "qwingt@gmail.com","address": "ul. Rhylova 8","city": "Poling","state": "LV","zip": "75333","country": "DE"
            ,"phone": "+1.9175313444","extras": ""},"tech_contact": {"org": "Fozzy","name": "Logika","email": 
            "qwingt@gmail.com","address": "ul. Rhylova 8","city": "Poling","state": "LV","zip": "75333","country": 
            "DE","phone": "+1.9175313444","extras": ""},"billing_contact": {"org": "Fozzy","name": "Logika","email": 
            "qwingt@gmail.com","address": "ul. Rhylova 8","city": "Poling","state": "LV","zip": "75333","country": "DE"
            ,"phone": "+1.9175313444","extras": ""}}]}'
        );

        $result = $this->runAPI(
            TransferIn::class,
            'getTransfersList',
            [1, 30, 'example', 'waiting registrant confirmation'],
            $response
        );
        $this->assertInstanceOf(MetaResponse::class, $result);
    }

    public function testTransferCancel(): void
    {
        $response = new Response(
            200,
            ['Content-Type' => 'application/json; charset=UTF-8'],
            ''
        );

        $result = $this->runAPI(TransferIn::class, 'cancel', ['example.com'], $response);
        $this->assertEquals(true, $result);
    }
}
