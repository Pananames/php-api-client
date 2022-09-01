<?php

namespace Pananames\Api\V2\Entities;

use Pananames\Api\V2\Response\BaseResponse;
use Pananames\Api\V2\Response\TransferIn\TransfersListResponse;

class TransferIn extends Entity
{
    /**
     * @param $currentPage
     * @param $perPage
     * @param $domainLike
     * @param $status
     *
     * @return TransfersListResponse
     *
     * @throws \Pananames\Api\Exceptions\InvalidApiResponse
     */
    public function getTransfersList(
        $currentPage = '1',
        $perPage = '30',
        $domainLike = null,
        $status = null
    ): TransfersListResponse {

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

        $transfersListResponse = new TransfersListResponse($dataContents['data']);
        $transfersListResponse->setHttpCode($response->getStatusCode());
        $transfersListResponse->setMeta($dataContents['meta']);

        return $transfersListResponse;
    }

    /**
     * @param $data
     *
     * @return BaseResponse
     *
     * @throws \Pananames\Api\Exceptions\InvalidApiResponse
     */
    public function initTransfetIn($data): BaseResponse
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
