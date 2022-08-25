<?php

namespace Pananames\Api\V2\HttpClients;

use Exception;
use Pananames\Api\Exceptions\InvalidApiResponse;
use Pananames\Api\V2\HttpClients\HttpClient;
use GuzzleHttp\Client;

class Guzzle extends HttpClient
{
    const HEADER_ACCEPT = 'application/json';
    const HEADER_CONTENT_TYPE = 'application/json';

    /**
     * Guzzle client
     */
    public $client;

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
     * @param string $resource API resource
     * @param string $method Request method
     * @param array $headers Request headers
     * @param array $queryParams Request GET params
     * @param array $formParams Request form params
     *
     * @throws InvalidApiResponse
     * @throws Exception
     */
    public function request(string $resource, string $method = 'GET', array $headers = [], array $queryParams = [], array $formParams = [])
    {
        $options = [];
        if (!empty($headers)) {
            $options['headers'] = $headers;
        }
        if (!empty($queryParams)) {
            $options['query'] = $queryParams;
        }
        if (!empty($formParams)) {
            $options['form_params'] = $formParams;
        }

        $response = $this->client->request($method, $resource, $options);
        $statusCode = $response->getStatusCode();
        $content = $response->getBody()->getContents();

        if ($statusCode == 204 && empty($content)) {
            return true;
        }

        $content = json_decode($content, true);
        if (is_null($content)) {
            throw new InvalidApiResponse;
        }

        $statusCode = $response->getStatusCode();
        if ($statusCode >= 400 || !empty($content['error'])) {
            $error = empty($content['error']) ? $response->getReasonPhrase() : $content['error'];
            throw new Exception($error);
        }

        return $content;
    }
}