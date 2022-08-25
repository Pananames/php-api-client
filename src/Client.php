<?php

namespace Pananames\Api;

use Pananames\Api\Exceptions\InvalidApiVersion;
use Pananames\Api\Exceptions\InvalidHttpClient;

class Client
{
    /**
     * @param string $signature
     * @param string|null $apiUrl
     * @param string $apiVersion
     * @param string $httpClient
     * @return mixed
     * @throws InvalidApiVersion
     * @throws InvalidHttpClient
     */
    public static function make(
        string $signature,
        string $apiUrl = null,
        string $apiVersion = 'v2',
        string $httpClient = 'guzzle'
    ) {
        $clientClassname = __NAMESPACE__ . '\\' . ucfirst($apiVersion) . '\\Client';
        if (!class_exists($clientClassname)) {
            throw new InvalidApiVersion;
        }

        $httpClientClassname = __NAMESPACE__ . '\\' . ucfirst($apiVersion) . '\\HttpClients\\' . ucfirst($httpClient);
        if (!class_exists($httpClientClassname)) {
            throw new InvalidHttpClient;
        }

        $apiUrl = empty($apiUrl) ? $clientClassname::DEFAULT_API_URL : $apiUrl;
        $httpClient = new $httpClientClassname($signature, $apiUrl);

        return new $clientClassname($httpClient);
    }
}