<?php

namespace Pananames\Api\V2\Entities;

use Pananames\Api\V2\Response\BaseResponse;
use Pananames\Api\V2\Response\MetaResponse;

class TransferIn extends Entity
{
    /**
     * @param int $currentPage
     * @param int $perPage
     * @param string $domainLike
     * @param string $status
     *
     * @return MetaResponse
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Pananames\Api\Exceptions\InvalidApiResponse
     */
    public function getTransfersList(
        int $currentPage = 1,
        int $perPage = 30,
        string $domainLike = '',
        string $status = ''
    ): MetaResponse {

        $response = $this->httpClient->request(
            'transfers_in',
            'GET',
            [],
            [
                'current_page' => $currentPage,
                'per_page' => $perPage,
                'domain_like' => $domainLike,
                'status' => $status,
            ]
        );

        $dataContents = json_decode($response->getBody()->getContents(), true);

        $this->validate($response, $dataContents, 'TransferIn/TransfersList');

        $transfersListResponse = new MetaResponse($dataContents['data']);
        $transfersListResponse->setHttpCode($response->getStatusCode());
        $transfersListResponse->setMeta($dataContents['meta']);

        return $transfersListResponse;
    }

    /**
     * @param array $data
     *
     * @return BaseResponse
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Pananames\Api\Exceptions\InvalidApiResponse
     */
    public function initTransfetIn(array $data): BaseResponse
    {
        $response = $this->httpClient->request('transfers_in', 'POST', [], [], $data);

        $dataContents = json_decode($response->getBody()->getContents(), true);

        $this->validate($response, $dataContents, 'TransferIn/Transfer');

        $transferInResponse = new BaseResponse($dataContents['data']);
        $transferInResponse->setHttpCode($response->getStatusCode());

        return $transferInResponse;
    }

    /**
     * @param string $domain
     *
     * @return bool
     *
     * @throws \Pananames\Api\Exceptions\InvalidApiResponse
     */
    public function cancel(string $domain): bool
    {
        $response = $this->httpClient->request('transfers_in', 'DELETE', [], [], ['domain' => $domain]);

        $dataContents = $response->getBody()->getContents();

        $this->validate($response, $dataContents);

        return true;
    }
}
