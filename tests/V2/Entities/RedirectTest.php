<?php

namespace Pananames\Tests\V2\Entities;


use GuzzleHttp\Psr7\Response;
use Pananames\Api\V2\Entities\Redirect;
use Pananames\Api\V2\Response\BaseResponse;
use Pananames\Api\V2\Response\MetaResponse;

class RedirectTest extends ApiEntityTest
{
    public function testRedirect(): void
    {
        $response = new Response(
            200,
            ['Content-Type' => 'application/json; charset=UTF-8'],
            '{"data":{"url":"https://testdomain.com","masking_enabled":true,"masking_title":"Title for mask",
            "masking_desc":"Desc for mask","masking_kwd":"Keywords for mask"}}'
        );

        $result = $this->runAPI(Redirect::class, 'getRedirect', ['example.com'], $response);
        $this->assertInstanceOf(BaseResponse::class, $result);
    }

    public function testEnable(): void
    {
        $response = new Response(
            200,
            ['Content-Type' => 'application/json; charset=UTF-8'],
            '{"data":{"url":"https://redirectexample.com","masking_enabled":true,"masking_title":"Title for mask",
            "masking_desc":"Desc for mask","masking_kwd":"Keywords for mask"}}'
        );

        $redData = [
            'url' => 'https://redirectexample.com',
            'masking_enabled' => true,
            'masking_title' => 'Title for mask',
            'masking_desc' => 'Desc for mask',
            'masking_kwd' => 'Keywords for mask',
        ];
        $result = $this->runAPI(Redirect::class, 'enable', ['example.com', $redData], $response);
        $this->assertInstanceOf(BaseResponse::class, $result);
    }
}
