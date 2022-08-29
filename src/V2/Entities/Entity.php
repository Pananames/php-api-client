<?php

namespace Pananames\Api\V2\Entities;

use Pananames\Api\Exceptions\InvalidApiResponse;
use Pananames\Api\V2\HttpClients\HttpClient;
use Pananames\Api\V2\Validator\Validator;

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

    public function validate($dataContents, string $schema): void
    {
        if (is_null($dataContents)) {
            throw new InvalidApiResponse;
        }

        $validator = new Validator($schema);
        $validator->validate($dataContents);
    }
}
