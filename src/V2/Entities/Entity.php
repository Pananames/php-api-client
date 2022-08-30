<?php

namespace Pananames\Api\V2\Entities;

use Pananames\Api\Exceptions\InvalidApiResponse;
use Pananames\Api\V2\HttpClients\HttpClient;
use Pananames\Api\V2\Validator\Validator;
use Psr\Http\Message\ResponseInterface;
use Exception;

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

    /**
     * @param ResponseInterface $response
     * @param $dataContents
     * @param string $schema
     *
     * @return void
     *
     * @throws InvalidApiResponse
     * @throws Exception
     */
    public function validate(ResponseInterface $response, $dataContents, string $schema): void
    {
        if (is_null($dataContents)) {
            throw new InvalidApiResponse;
        }

        if ($response->getStatusCode() >= 400 || !empty($dataContents['errors'])) {
            $error = empty($dataContents['errors'])
                ? $response->getReasonPhrase()
                : "{$dataContents['errors'][0]['message']} {$dataContents['errors'][0]['description']}";
            throw new Exception($error);
        }

        $validator = new Validator($schema);
        $validator->validate($dataContents);
    }
}
