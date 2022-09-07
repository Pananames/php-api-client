<?php

namespace Pananames\Api\V2\Entities;

use Pananames\Api\Exceptions\InvalidApiResponse;
use Pananames\Api\V2\HttpClients\Guzzle;
use Pananames\Api\V2\Validator\Validator;
use Psr\Http\Message\ResponseInterface;
use Exception;

class Entity
{
    /**
     * @var Guzzle
     */
    public Guzzle $httpClient;

    public function __construct(Guzzle $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    /**
     * @param ResponseInterface $response
     * @param array|string $dataContents
     * @param string $schema
     *
     * @return void
     *
     * @throws InvalidApiResponse
     */
    public function validate(ResponseInterface $response, array|string $dataContents, string $schema = ''): void
    {
        if (is_array($dataContents) && empty($dataContents)) {
            throw new InvalidApiResponse;
        }

        if ($response->getStatusCode() >= 400 || !empty($dataContents['errors'])) {
            $error = empty($dataContents['errors'])
                ? $response->getReasonPhrase()
                : "{$dataContents['errors'][0]['message']} {$dataContents['errors'][0]['description']}";
            throw new InvalidApiResponse($error);
        }

        if ($schema) {
            $validator = new Validator($schema);
            $validator->validate($dataContents);
        }
    }
}
