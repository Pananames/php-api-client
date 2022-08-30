<?php

namespace Pananames\Api\V2\Entities;

use Pananames\Api\V2\Response\TransferIn\TransferInResponse;

class TransferIn extends Entity
{
    public function getTransfersList(
        $currentPage = '1',
        $perPage = '30',
        $domainLike = null,
        $status = null
    ): TransferInResponse {

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

        $dataContents = json_decode($response->getBody()->getContents(), 1);

        $this->validate($response, $dataContents, 'TransferIn/TransfersList');

        $transferInResponse = new TransferInResponse($dataContents['data']);
        $transferInResponse->setHttpCode($response->getStatusCode());
        $transferInResponse->setMeta($dataContents['meta']);

        return $transferInResponse;
    }
}
