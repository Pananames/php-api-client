<?php

namespace Pananames\Tests\V2\HttpClients;

use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use Pananames\Api\V2\HttpClients\Guzzle;
use PHPUnit\Framework\TestCase;

class GuzzleTest extends TestCase
{
    public function testGuzzleInvalidHandler(): void
    {
        $this->expectError();
        new Guzzle('test', 'test', ['test']);
    }

    public function testGuzzleEmptyHandler(): void
    {
        $client = new Guzzle('test', 'test');
        $this->assertInstanceOf(Guzzle::class, $client);
    }

    public function testGuzzleValidHandler(): void
    {
        $mock = new MockHandler(
            [new Response(200, ['Content-Length' => 0])]
        );

        $handlerStack = HandlerStack::create($mock);
        $client = new Guzzle('test', 'test', $handlerStack);
        $this->assertInstanceOf(Guzzle::class, $client);
    }

    public function testGuzzleInvalidApiUrl(): void
    {
        $this->expectError();
        new Guzzle('test', ['test']);
    }

    public function testGuzzleEmptyApiUrl(): void
    {
        $this->expectError();
        new Guzzle('test');
    }

    public function testGuzzleInvalidApiKey(): void
    {
        $this->expectError();
        new Guzzle(['test'], 'test');
    }

    public function testGuzzleNullApiKey(): void
    {
        $this->expectError();
        new Guzzle(null, 'test');
    }

    public function testGuzzleRequestEmptyResource(): void
    {
        $this->expectError();
        $client = new Guzzle('test', 'test');
        $client->request();
    }

    public function testGuzzleStdClassResponse(): void
    {
        $mock = new MockHandler(
            [new Response(
                200,
                ['Content-Type' => 'application/json; charset=UTF-8'],
                '{"meta": {"current_page": 1,"per_page": 3,"total_entries": 1495,"total_pages": 499},"data": 
                [{"txid": "2373","txdate": "2022-09-06 07:06:25","txtype": "renew","domain": "EXAMPLE.XYZ","period": "1"
                ,"description": "","total": -8.18},{"txid": "2372","txdate": "2022-09-06 07:06:03","txtype": "renew",
                "domain": "EXAMPLE.XYZ","period": "1","description": "","total": -8.18},{"txid": "2371","txdate": 
                "2022-09-05 11:31:40","txtype": "refund","domain": "NEWEXAMPLEFOR.XYZ","period": "","description": "",
                "total": 8.18}]}'
            )]
        );

        $handlerStack = HandlerStack::create($mock);
        $client = new Guzzle('test', 'test', $handlerStack);
        $response = $client->request('account/payments', 'GET', [], ['current_page' => 1, 'per_page' => 3]);
        $result = json_decode($response->getBody()->getContents(), true);

        $this->assertIsArray($result);
        $this->assertArrayHasKey('data', $result);
        $this->assertArrayHasKey('meta', $result);
    }

    public function testGuzzleEmptyResponse(): void
    {
        $mock = new MockHandler(
            [new Response(
                204,
                ['Content-Length' => 0]
            )]
        );

        $handlerStack = HandlerStack::create($mock);
        $client = new Guzzle('test', 'test', $handlerStack);
        $response = $client->request('domains/example.xyz/auto_renew', 'DELETE');
        $this->assertEmpty($response->getBody()->getContents());
    }

    public function testGuzzleBadResponse(): void
    {
        $mock = new MockHandler(
            [new Response(
                400,
                ['Content-Type' => 'application/json; charset=UTF-8'],
                '{"errors": [{"code": 3,"message": "Unable to perform this operation.","description": 
                "Permission Error for Domain. name: NONAME.XYZ"}]}'
            )]
        );

        $handlerStack = HandlerStack::create($mock);
        $client = new Guzzle('test', 'test', $handlerStack);
        $response = $client->request('domains/noname.xyz');
        $content = $result = json_decode($response->getBody()->getContents(), true);

        $this->assertObjectHasAttribute('reasonPhrase', $response);
        $this->assertEquals(400, $response->getStatusCode());
        $this->assertIsArray($content);
        $this->assertArrayHasKey('errors', $result);
        $this->assertArrayHasKey('description', $result['errors'][0]);
        $this->assertArrayHasKey('message', $result['errors'][0]);
    }
}
