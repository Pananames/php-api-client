<?php

namespace Pananames\Api\V2\Entities;

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
}
