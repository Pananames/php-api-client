<?php

namespace Pananames\Api\V2\HttpClients;

class HttpClient
{
    /**
     * API Token
     *
     * @var string
     */
    public string $signature;

    /**
     * API Url
     *
     * @var string
     */
    public string $apiUrl;

    public function __construct(string $signature, string $apiUrl)
    {
        $this->signature = $signature;
        $this->apiUrl = $apiUrl;
    }
}
