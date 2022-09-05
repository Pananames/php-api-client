<?php

namespace Pananames\Api\V2\Entities;

use Pananames\Api\V2\Response\BaseResponse;

class Whois extends Entity
{
    /**
     * @param string $domain
     * @param bool $preview
     *
     * @return BaseResponse
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Pananames\Api\Exceptions\InvalidApiResponse
     */
    public function getWhois(string $domain, bool $preview = false): BaseResponse
    {
        $response = $this->httpClient->request($this->getWhoisResource($domain), 'GET', [], ['preview' => $preview]);
        $dataContents = json_decode($response->getBody()->getContents(), true);

        $this->validate($response, $dataContents, 'Whois/Whois');

        $whoisResponse = new BaseResponse($dataContents['data']);
        $whoisResponse->setHttpCode($response->getStatusCode());

        return $whoisResponse;
    }

    /**
     * @param string $domain
     * @param array $whoisInfo
     *
     * @return BaseResponse
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Pananames\Api\Exceptions\InvalidApiResponse
     */
    public function setWhois(string $domain, array $whoisInfo): BaseResponse
    {
        $response = $this->httpClient->request($this->getWhoisResource($domain), 'PUT', [], [], $whoisInfo);
        $dataContents = json_decode($response->getBody()->getContents(), true);

        $this->validate($response, $dataContents, 'Whois/Whois');

        $whoisResponse = new BaseResponse($dataContents['data']);
        $whoisResponse->setHttpCode($response->getStatusCode());

        return $whoisResponse;
    }

    /**
     * @param string $domain
     *
     * @return string
     */
    private function getWhoisResource(string $domain): string
    {
        return str_replace('{'.'domain'.'}', rawurlencode($domain), 'domains/{domain}/whois');
    }
}
