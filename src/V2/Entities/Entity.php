<?php

namespace Pananames\Api\V2\Entities;

use Pananames\Api\V2\HttpClients\HttpClient;

class Entity
{
    /**
     * HTTP Client which using for API requests
     */
    public $httpClient;

    public function __construct(HttpClient $httpClient)
    {
        $this->httpClient = $httpClient;
    }
}
