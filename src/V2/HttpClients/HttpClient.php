<?php

namespace Pananames\Api\V2\HttpClients;

class HttpClient
{
    /**
     * API Token
     *
     * @var string
     */
    public $signature;

    /**
     * API Url
     *
     * @var string
     */
    public $apiUrl;

    public function __construct(string $signature, string $apiUrl)
    {
        $this->signature = $signature;
        $this->apiUrl = $apiUrl;
    }
}
