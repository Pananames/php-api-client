<?php

namespace Pananames\Tests\V2\Entities;

use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use Pananames\Api\V2\HttpClients\Guzzle;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;

class ApiEntityTest extends TestCase
{
    /**
     * @param string $class
     * @param string $method
     * @param array $params
     * @param ResponseInterface $response
     *
     * @return mixed
     */
    public function runAPI(string $class, string $method, array $params, ResponseInterface $response): mixed
    {
        $mock = new MockHandler([$response]);
        $handlerStack = HandlerStack::create($mock);
        $httpClient = new Guzzle('test', 'test', $handlerStack);
        $entity = new $class($httpClient);

        return call_user_func_array([$entity, $method], $params);
    }

    public function testNoTest(): void
    {
        $this->markTestSkipped();
    }
}
