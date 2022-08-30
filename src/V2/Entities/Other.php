<?php

namespace Pananames\Api\V2\Entities;

use Pananames\Api\V2\Response\Other\EmailsResponse;
use Pananames\Api\V2\Response\Other\TldsResponse;

class Other extends Entity
{
    public function tlds(): TldsResponse
    {
        $response = $this->httpClient->request('tlds', 'GET', []);
        $dataContents = json_decode($response->getBody()->getContents(), 1);

        $this->validate($response, $dataContents, 'Other/Tlds');

        $tldsResponse = new TldsResponse($dataContents['data']);
        $tldsResponse->setHttpCode($response->getStatusCode());

        return $tldsResponse;
    }

    public function emails(
        int $currentPage,
        int $perPage,
        string $emailLike,
        string $status,
        string $emailStatus
    ): EmailsResponse {
        $response = $this->httpClient->request(
            'emails',
            'GET',
            [],
            [
                'current_page' => $currentPage,
                'per_page' => $perPage,
                'email_like' => $emailLike,
                'status' => $status,
                'email_status' => $emailStatus,
            ]
        );

        $dataContents = json_decode($response->getBody()->getContents(), 1);

        $this->validate($response, $dataContents, 'Other/Emails');

        $emailsResponse = new EmailsResponse($dataContents['data']);
        $emailsResponse->setHttpCode($response->getStatusCode());
        $emailsResponse->setMeta($dataContents['meta']);

        return $emailsResponse;
    }
}
