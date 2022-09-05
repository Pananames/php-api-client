<?php

namespace Pananames\Api\V2\Entities;

use Pananames\Api\V2\Response\Account\BalanceResponse;
use Pananames\Api\V2\Response\MetaResponse;

class Account extends Entity
{
    /**
     * @return BalanceResponse
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Pananames\Api\Exceptions\InvalidApiResponse
     */
    public function getBalance(): BalanceResponse
    {
        $response = $this->httpClient->request('account/balance', 'GET', []);
        $dataContents = json_decode($response->getBody()->getContents(), true);

        $this->validate($response, $dataContents, 'Account/Balance');

        $balanceResponse = new BalanceResponse($dataContents['data']);
        $balanceResponse->setHttpCode($response->getStatusCode());

        return $balanceResponse;
    }

    /**
     * @param int $currentPage
     * @param int $perPage
     * @param int|null $id
     * @param string $payType
     * @param string $domainLike
     * @param string $dateFrom
     * @param string $dateEnd
     *
     * @return MetaResponse
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Pananames\Api\Exceptions\InvalidApiResponse
     */
    public function getPayments(
        int $currentPage = 1,
        int $perPage = 30,
        int $id = null,
        string $payType = 'create',
        string $domainLike = '',
        string $dateFrom = '',
        string $dateEnd = ''
    ): MetaResponse {

        $response = $this->httpClient->request(
            'account/payments',
            'GET',
            [],
            [
                'current_page' => $currentPage,
                'per_page' => $perPage,
                'id' => $id,
                'pay_type' => $payType,
                'domain_like' => $domainLike,
                'date_from' => $dateFrom,
                'date_end' => $dateEnd,
            ]
        );

        $dataContents = json_decode($response->getBody()->getContents(), true);

        $this->validate($response, $dataContents, 'Account/Payments');

        $paymentsResponse = new MetaResponse($dataContents['data']);
        $paymentsResponse->setHttpCode($response->getStatusCode());
        $paymentsResponse->setMeta($dataContents['meta']);

        return $paymentsResponse;
    }
}
