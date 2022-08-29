<?php

namespace Pananames\Api\V2\Entities;

use Pananames\Api\V2\Response\Account\BalanceResponse;
use Pananames\Api\V2\Response\Account\PaymentsResponse;

class Account extends Entity
{
    public function balance(): BalanceResponse
    {
        $response = $this->httpClient->request('account/balance', 'GET', []);
        $dataContents = json_decode($response->getBody()->getContents(), 1);

        $this->validate($response, $dataContents, 'Account/Balance');

        $balanceResponse = new BalanceResponse($dataContents['data']);
        $balanceResponse->setHttpCode($response->getStatusCode());

        return $balanceResponse;
    }

    public function payments(
        int $currentPage = 1,
        int $perPage = 30,
        int $id = null,
        string $payType = 'create',
        string $domainLike = '',
        string $dateFrom = '',
        string $dateEnd = ''
    ): PaymentsResponse {

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

        $dataContents = json_decode($response->getBody()->getContents(), 1);

        $this->validate($response, $dataContents, 'Account/Payments');

        $paymentsResponse = new PaymentsResponse($dataContents['data']);
        $paymentsResponse->setHttpCode($response->getStatusCode());
        $paymentsResponse->setMeta($dataContents['meta']);

        return $paymentsResponse;
    }
}
