<?php

namespace Pananames\Tests;

use Pananames\Api\Client;
use Pananames\Api\V2\Client as ClientV2;
use Pananames\Api\Exceptions\InvalidApiVersion;
use Pananames\Api\Exceptions\InvalidHttpClient;
use PHPUnit\Framework\TestCase;

class ClientTest extends TestCase
{
    public function testClientMakeInvalidHttpClient(): void
    {
        $this->expectException(InvalidHttpClient::class);
        Client::make('test', 'test', 'v2', 'curl');
    }

    public function testClientMakeEmptyHttpClient(): void
    {
        $client = Client::make('test', 'test', 'v2');
        $this->assertInstanceOf(ClientV2::class, $client);
    }

    public function testClientMakeInvalidApiVersion(): void
    {
        $this->expectException(InvalidApiVersion::class);
        Client::make('test', 'test', 'v3');
    }

    public function testClientMakeEmptyApiVersion(): void
    {
        $client = Client::make('test', 'test');
        $this->assertInstanceOf(ClientV2::class, $client);
    }

    public function testClientMakeInvalidApiUrl(): void
    {
        $this->expectError();
        Client::make('test', ['test']);
    }

    public function testClientMakeEmptyApiUrl(): void
    {
        $client = Client::make('test');
        $this->assertInstanceOf(ClientV2::class, $client);
    }

    public function testClientMakeInvalidApiKey(): void
    {
        $this->expectError();
        Client::make(['test']);
    }

    public function testClientMakeEmptyApiKey(): void
    {
        $this->expectError();
        Client::make();
    }
}
