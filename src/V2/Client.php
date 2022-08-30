<?php

namespace Pananames\Api\V2;

use Pananames\Api\V2\Entities\Account;
use Pananames\Api\V2\Entities\Other;
use Pananames\Api\V2\Entities\TransferIn;
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
     * @var Other
     */
    public $otherInstance;

    /**
     * @var TransferIn
     */
    public $transferInInstance;

    /**
     * Create and return TransferIn instance
     *
     * @return TransferIn
     */
    public function transferIn(): TransferIn
    {
        if (!$this->transferInInstance) {
            $this->transferInInstance = new TransferIn($this->httpClient);
        }

        return $this->transferInInstance;
    }


    /**
     * Create and return Account instance
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
     *
     * @return Other
     */
    public function other(): Other
    {
        if (!$this->otherInstance) {
            $this->otherInstance = new Other($this->httpClient);
        }

        return $this->otherInstance;
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
