<?php

namespace Pananames\Tests\V2;

use Pananames\Api\V2\Client;
use Pananames\Api\V2\HttpClients\Guzzle;
use PHPUnit\Framework\TestCase;

class ClientTest extends TestCase
{
    public function testClientInvalidHttpClient(): void
    {
        $this->expectError();
        new Client('test');
    }

    public function testClientEmptyHttpClient(): void
    {
        $this->expectError();
        new Client();
    }

    public function testClientCreate(): void
    {
        $httpClient = new Guzzle('test', 'test');
        $client = new Client($httpClient);
        $this->assertInstanceOf(Client::class, $client);
    }
}
