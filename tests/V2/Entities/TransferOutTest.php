<?php

namespace Pananames\Tests\V2\Entities;

use GuzzleHttp\Psr7\Response;
use Pananames\Api\V2\Entities\TransferOut;

class TransferOutTest extends ApiEntityTest
{
    public function testInitTransfer(): void
    {
        $response = new Response(200, ['Content-Type' => 'application/json; charset=UTF-8'], '');

        $result = $this->runAPI(TransferOut::class, 'initTransferOut', ['example.com'], $response);
        $this->assertEquals(true, $result);
    }

    public function testCancelTransfer(): void
    {
        $response = new Response(200, ['Content-Type' => 'application/json; charset=UTF-8'], '');

        $result = $this->runAPI(TransferOut::class, 'cancelTransferOut', ['example.com'], $response);
        $this->assertEquals(true, $result);
    }
}
