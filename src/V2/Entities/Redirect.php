<?php

namespace Pananames\Api\V2\Entities;

use Pananames\Api\V2\Response\BaseResponse;

class Redirect extends Entity
{
    /**
     * @param string $domain
     *
     * @return BaseResponse
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Pananames\Api\Exceptions\InvalidApiResponse
     */
    public function getRedirect(string $domain): BaseResponse
    {
        $response = $this->httpClient->request($this->getRedirectResource($domain));
        $dataContents = json_decode($response->getBody()->getContents(), true);

        $this->validate($response, $dataContents, 'Redirect/Redirect');

        $redirectResponse = new BaseResponse($dataContents['data']);
        $redirectResponse->setHttpCode($response->getStatusCode());

        return $redirectResponse;
    }

    /**
     * @param string $domain
     * @param array<string, bool|string> $redirect
     *
     * @return BaseResponse
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Pananames\Api\Exceptions\InvalidApiResponse
     */
    public function enable(string $domain, array $redirect): BaseResponse
    {
        $response = $this->httpClient->request($this->getRedirectResource($domain), 'PUT', [], [], $redirect);
        $dataContents = json_decode($response->getBody()->getContents(), true);

        $this->validate($response, $dataContents, 'Redirect/Redirect');

        $redirectResponse = new BaseResponse($dataContents['data']);
        $redirectResponse->setHttpCode($response->getStatusCode());

        return $redirectResponse;
    }

    /**
     * @param string $domain
     *
     * @return bool
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Pananames\Api\Exceptions\InvalidApiResponse
     */
    public function disable(string $domain): bool
    {
        $response = $this->httpClient->request($this->getRedirectResource($domain), 'DELETE');
        $dataContents = $response->getBody()->getContents();

        $this->validate($response, $dataContents);

        return true;
    }

    /**
     * @param string $domain
     *
     * @return string
     */
    private function getRedirectResource(string $domain): string
    {
        return str_replace('{'.'domain'.'}', rawurlencode($domain), 'domains/{domain}/redirect');
    }
}
