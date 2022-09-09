<?php

namespace Pananames\Tests\V2\Entities;


use GuzzleHttp\Psr7\Response;
use Pananames\Api\V2\Entities\NameServers;
use Pananames\Api\V2\Response\BaseResponse;

class NameServersTest extends ApiEntityTest
{
    public function testDnsServers(): void
    {
        $response = new Response(
            200,
            ['Content-Type' => 'application/json; charset=UTF-8'],
            '{"data":["ns1.pananames.com","ns2.pananames.com","ns3.pananames.com","ns4.pananames.com"]}'
        );

        $result = $this->runAPI(NameServers::class, 'getDnsServers', ['example.xyz'], $response);
        $this->assertInstanceOf(BaseResponse::class, $result);
    }

    public function testNameServerRecords(): void
    {
        $response = new Response(
            200,
            ['Content-Type' => 'application/json; charset=UTF-8'],
            '{"data":[{"id":"5169926362542c0b93bd87334a5068dc","name":"www","type":"A","value":"199.80.53.28",
            "priority":0,"ttl":300},{"id":"5a6fe121fcba7342d3e4f951f7d4f3a7","name":"*","type":"A","value":
            "199.80.53.28","priority":0,"ttl":300},{"id":"dc1020984cd9e21242c02125f2a09e81","name":"","type":"NS",
            "value":"ns1.pananames.com.","priority":0,"ttl":300},{"id":"442404d188ef97ff3776588a3767685a","name":"",
            "type":"NS","value":"ns2.pananames.com.","priority":0,"ttl":300},{"id":"868e0d4f87648e51a8f43f69958bcb63",
            "name":"","type":"NS","value":"ns3.pananames.com.","priority":0,"ttl":300},{"id":
            "2ddfa298f1b83e6c4a7a9955645b56ee","name":"","type":"NS","value":"ns4.pananamesup.com.","priority":0,
            "ttl":300}]}'
        );

        $result = $this->runAPI(NameServers::class, 'getDnsRecords', ['example.xyz'], $response);
        $this->assertInstanceOf(BaseResponse::class, $result);
    }

    public function testCreateNameServerRecords(): void
    {
        $response = new Response(
            200,
            ['Content-Type' => 'application/json; charset=UTF-8'],
            '{"data":["ns1.fozzy.com","ns2.fozzy.com"]}'
        );

        $nameServers = [
            'ns1.fozzy.com',
            'ns2.fozzy.com',
        ];
        $result = $this->runAPI(NameServers::class, 'createDnsRecord', ['example.xyz', $nameServers], $response);
        $this->assertInstanceOf(BaseResponse::class, $result);
    }

    public function testInvalidParams(): void
    {
        $this->expectError();
        $response = new Response(
            200,
            ['Content-Type' => 'application/json; charset=UTF-8'],
            '{"data":["ns1.fozzy.com","ns2.fozzy.com"]}'
        );

        $this->runAPI(NameServers::class, 'createDnsRecord', ['example.xyz'], $response);
    }
}
