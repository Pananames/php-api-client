<?php

namespace Pananames\Tests\V2\Entities;


use GuzzleHttp\Psr7\Response;
use Pananames\Api\V2\Entities\Other;
use Pananames\Api\V2\Response\BaseResponse;
use Pananames\Api\V2\Response\MetaResponse;

class OtherTest extends ApiEntityTest
{
    public function testNoticesList(): void
    {
        $body = '{"data":[{"tld":"APP","notices":["<p>Google notice example for test environment</p>"]},{"tld":"CLUB","'
            .'notices":["<p><strong>THIS NOTICE IS FOR CLUB</strong></p>\r\n<p>&nbsp;</p>\r\n<p>THIS NOTICE IS FOR CLUB'
            .'</p>\r\n<p>THIS NOTICE IS FOR CLUB</p>\r\n<p>THIS NOTICE IS FOR CLUB</p>\r\n<p>THIS NOTICE IS FOR CLUB'
            .'</p>\r\n<p>THIS NOTICE IS FOR CLUB</p>"]},{"tld": "INFO","notices":["<p><strong>This tld notice is for '
            .'INFO</strong></p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p>This tld notice is for INFO</p>\r\n<p>This tld '
            .'notice is for INFO</p>\r\n<p>This tld notice is for INFO</p>\r\n<p>This tld notice is for INFO</p>\r\n<p>'
            .'This tld notice is for INFO</p>\r\n<p>This tld notice is for INFO</p>"]},{"tld": "SITE","notices":["<p>'
            .'<strong>THIS NOTICE IS FOR SIte</strong></p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p>'
            .'THIS NOTICE IS FOR SIte</p>\r\n<p>THIS NOTICE IS FOR SIte</p>\r\n<p>THIS NOTICE IS FOR SIte</p>\r\n<p>'
            .'THIS NOTICE IS FOR SIte</p>\r\n<p>THIS NOTICE IS FOR SIte</p>"]}]}';

        $response = new Response(200, ['Content-Type' => 'application/json; charset=UTF-8'], $body);

        $result = $this->runAPI(Other::class, 'getNoticesList', [], $response);
        $this->assertInstanceOf(BaseResponse::class, $result);
    }

    public function testEmails(): void
    {
        $response = new Response(
            200,
            ['Content-Type' => 'application/json; charset=UTF-8'],
            '{"meta":{"current_page":1,"per_page":30,"total_entries":1,"total_pages":1},"data":[{"email":
            "test@fozzy.com","first_email_date":"2020-10-02T14:41:04Z","verify_date":"","suspend_date":
            "2020-10-17T14:41:04Z","status":"suspended","domains":[{"domain":"example.vin","status":"ok"},{"domain":
            "example.shop","status":"redemption"},{"domain":"example.online","status":"ok"},{"domain":"example.xyz",
            "status":"ok"},{"domain":"example.ws","status":"expired"},{"domain":"example.best","status":"ok"}]}]}'
        );

        $result = $this->runAPI(Other::class, 'getEmails', [1, 30, 'test', 'ok', 'suspended'], $response);
        $this->assertInstanceOf(MetaResponse::class, $result);
    }
}
