<?php

namespace Pananames\Api\V2;

use Pananames\Api\V2\Entities\Account;
use Pananames\Api\V2\HttpClients\HttpClient;

class Client
{
    /**
     * Default endpoint for API v2
     */
    const DEFAULT_API_URL = 'https://api.pananames.com/merchant/v2/';

    /**
     * @var Account
     */
    public $accountInstance;

    /**
     * Create and return Brands instance
     *
     * @return Account
     */
    public function account(): Account
    {
        if (!$this->accountInstance) {
            $this->accountInstance = new Account($this->httpClient);
        }

        return $this->accountInstance;
    }

    /**
     * @var HttpClient
     */
    public $httpClient;

    public function __construct(HttpClient $httpClient)
    {
        $this->httpClient = $httpClient;
    }
}
