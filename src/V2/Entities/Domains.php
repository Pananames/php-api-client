<?php

namespace Pananames\Api\V2\Entities;

use Pananames\Api\V2\Response\BaseResponse;
use Pananames\Api\V2\Response\MetaResponse;

class Domains extends Entity
{
    public function getList(
        int $currentPage = 1,
        int $perPage = 30,
        string $lockStatus = '',
        string $status = '',
        string $domainLike = ''
    ): MetaResponse {

        $response = $this->httpClient->request(
            'domains',
            'GET',
            [],
            [
                'current_page' => $currentPage,
                'per_page' => $perPage,
                'lock_status' => $lockStatus,
                'status' => $status,
                'domain_like' => $domainLike,
            ]
        );
        $dataContents = json_decode($response->getBody()->getContents(), true);

        $this->validate($response, $dataContents, 'Domains/DomainsList');

        $domainsListResponse = new MetaResponse($dataContents['data']);
        $domainsListResponse->setHttpCode($response->getStatusCode());
        $domainsListResponse->setMeta($dataContents['meta']);

        return $domainsListResponse;
    }

    /**
     * @param array<string, mixed> $data
     *
     * @return BaseResponse
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Pananames\Api\Exceptions\InvalidApiResponse
     */
    public function register(array $data): BaseResponse
    {
        $response = $this->httpClient->request('domains', 'POST', [], [], $data);

        $dataContents = json_decode($response->getBody()->getContents(), true);

        $this->validate($response, $dataContents, 'Domains/Domain');

        $domainResponse = new BaseResponse($dataContents['data']);
        $domainResponse->setHttpCode($response->getStatusCode());

        return $domainResponse;
    }

    /**
     * @param string $domain
     *
     * @return BaseResponse
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Pananames\Api\Exceptions\InvalidApiResponse
     */
    public function getInfo(string $domain): BaseResponse
    {
        $response = $this->httpClient->request('domains/' . rawurlencode($domain));

        $dataContents = json_decode($response->getBody()->getContents(), true);

        $this->validate($response, $dataContents, 'Domains/Domain');

        $domainInfoResponse = new BaseResponse($dataContents['data']);
        $domainInfoResponse->setHttpCode($response->getStatusCode());

        return $domainInfoResponse;
    }

    /**
     * @param string $domain
     *
     * @return bool
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Pananames\Api\Exceptions\InvalidApiResponse
     */
    public function delete(string $domain): bool
    {
        $response = $this->httpClient->request(
            'domains/' . rawurlencode($domain),
            'DELETE',
            [],
            [],
            ['domain' => $domain]
        );

        $dataContents = $response->getBody()->getContents();

        $this->validate($response, $dataContents);

        return true;
    }

    /**
     * @param string $domain
     *
     * @return BaseResponse
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Pananames\Api\Exceptions\InvalidApiResponse
     */
    public function check(string $domain): BaseResponse
    {
        $response = $this->httpClient->request('domains/' . rawurlencode($domain) . '/check');

        $dataContents = json_decode($response->getBody()->getContents(), true);

        $this->validate($response, $dataContents, 'Domains/Check');

        $checkResponse = new BaseResponse($dataContents['data']);
        $checkResponse->setHttpCode($response->getStatusCode());

        return $checkResponse;
    }

    /**
     * @param string[] $domains
     *
     * @return BaseResponse
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Pananames\Api\Exceptions\InvalidApiResponse
     */
    public function bulkCheck(array $domains): BaseResponse
    {
        $response = $this->httpClient->request('domains/bulk_check', 'GET', [], ['domains' => implode(',', $domains)]);

        $dataContents = json_decode($response->getBody()->getContents(), true);

        $this->validate($response, $dataContents, 'Domains/BulkCheck');

        $checkResponse = new BaseResponse($dataContents['data']);
        $checkResponse->setHttpCode($response->getStatusCode());

        return $checkResponse;
    }

    /**
     * @param string $domain
     *
     * @return BaseResponse
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Pananames\Api\Exceptions\InvalidApiResponse
     */
    public function getAddReq(string $domain): BaseResponse
    {
        $response = $this->httpClient->request('domains/' . rawurlencode($domain) . '/add_req');

        $dataContents = json_decode($response->getBody()->getContents(), true);

        $this->validate($response, $dataContents, 'Domains/AddReq');

        $addReqResponse = new BaseResponse($dataContents);
        $addReqResponse->setHttpCode($response->getStatusCode());

        return $addReqResponse;
    }
}
