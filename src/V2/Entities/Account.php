<?php

namespace Pananames\Api\V2\Entities;

class Account extends Entity
{
//    /**
//     * Returns current balance.
//     *
//     * @return BalanceResponse
//     */
//    public function balance(): BalanceResponse
//    {
//        $response = $this->httpClient->request('account/balance', 'GET', []);
//        return BalanceResponse::make($response);
//    }


    public function balance()
    {
        $response = $this->httpClient->request('account/balance', 'GET', []);
        return $response;
    }
}
