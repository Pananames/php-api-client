<?php

namespace Pananames\Api\V2\Entities;

use Pananames\Api\V2\Response\Account\BalanceResponse;
use Exception;

class Account extends Entity
{
    public function balance(): BalanceResponse
    {
        $response = $this->httpClient->request('account/balance', 'GET', []);
        $dataContents = json_decode($response->getBody()->getContents(), 1);

        $this->validate($dataContents, 'Account/Balance');

        $statusCode = $response->getStatusCode();
        if ($statusCode >= 400 || !empty($dataContents['errors'])) {
            $error = empty($content['errors']) ? $response->getReasonPhrase() : $dataContents['errors'];
            throw new Exception($error);
        }

        $balanceResponse = new BalanceResponse($dataContents);
        $balanceResponse->setHttpCode($statusCode);

        return $balanceResponse;
    }
}
