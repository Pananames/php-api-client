<?php

namespace Pananames\Api\V2\Entities;

use Pananames\Api\V2\Response\BaseResponse;
use Pananames\Api\V2\Response\MetaResponse;

class Other extends Entity
{
    /**
     * @return BaseResponse
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Pananames\Api\Exceptions\InvalidApiResponse
     */
    public function getNoticesList(): BaseResponse
    {
        $response = $this->httpClient->request('add_req_list', 'GET', []);
        $dataContents = json_decode($response->getBody()->getContents(), true);

        $this->validate($response, $dataContents, 'Other/RegistrationNotices');

        $baseResponse = new BaseResponse($dataContents['data']);
        $baseResponse->setHttpCode($response->getStatusCode());

        return $baseResponse;
    }

    /**
     * @return BaseResponse
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Pananames\Api\Exceptions\InvalidApiResponse
     */
    public function getTlds(): BaseResponse
    {
        $response = $this->httpClient->request('tlds', 'GET', []);
        $dataContents = json_decode($response->getBody()->getContents(), true);

        $this->validate($response, $dataContents, 'Other/Tlds');

        $baseResponse = new BaseResponse($dataContents['data']);
        $baseResponse->setHttpCode($response->getStatusCode());

        return $baseResponse;
    }

    /**
     * @param int $currentPage
     * @param int $perPage
     * @param string $emailLike
     * @param string $status
     * @param string $emailStatus
     *
     * @return MetaResponse
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Pananames\Api\Exceptions\InvalidApiResponse
     */
    public function getEmails(
        int $currentPage,
        int $perPage,
        string $emailLike,
        string $status,
        string $emailStatus
    ): MetaResponse {
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

        $dataContents = json_decode($response->getBody()->getContents(), true);

        $this->validate($response, $dataContents, 'Other/Emails');

        $emailsResponse = new MetaResponse($dataContents['data']);
        $emailsResponse->setHttpCode($response->getStatusCode());
        $emailsResponse->setMeta($dataContents['meta']);

        return $emailsResponse;
    }
}
