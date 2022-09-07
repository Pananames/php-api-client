<?php

namespace Pananames\Api\V2\HttpClients;

use Psr\Http\Message\ResponseInterface;
use GuzzleHttp\Client;

class Guzzle extends HttpClient
{
    const HEADER_ACCEPT = 'application/json';
    const HEADER_CONTENT_TYPE = 'application/json';

    /**
     * Guzzle client
     *
     * @var Client
     */
    public Client $client;

    public function __construct(string $signature, string $apiUrl, callable $handler = null)
    {
        parent::__construct($signature, $apiUrl);

        $config = [
            'allow_redirects' => false,
            'base_uri' => $this->apiUrl,
            'headers' => [
                'Signature' => $signature,
                'Accept' => self::HEADER_ACCEPT,
                'Content-type' => self::HEADER_CONTENT_TYPE
            ],
            'http_errors' => false,
        ];

        if ($handler) {
            $config['handler'] = $handler;
        }

        $this->client = new Client($config);
    }

    /**
     * Send request to API
     *
     * @param string $resource
     * @param string $method
     * @param array $headers
     * @param array $queryParams
     * @param array $bodyParams
     *
     * @return ResponseInterface
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function request(
        string $resource,
        string $method = 'GET',
        array $headers = [],
        array $queryParams = [],
        array $bodyParams = []
    ): ResponseInterface {
        $options = [];
        if (!empty($headers)) {
            $options['headers'] = $headers;
        }
        if (!empty($queryParams)) {
            $options['query'] = $queryParams;
        }
        if (!empty($bodyParams)) {
            $options['body'] = json_encode($bodyParams);
        }

        return $this->client->request($method, $resource, $options);
    }
}