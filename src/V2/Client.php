<?php

namespace Pananames\Api\V2;

use Pananames\Api\V2\Entities\Account;
use Pananames\Api\V2\Entities\NameServers;
use Pananames\Api\V2\Entities\Other;
use Pananames\Api\V2\Entities\TransferIn;
use Pananames\Api\V2\Entities\TransferOut;
use Pananames\Api\V2\HttpClients\HttpClient;

class Client
{
    /**
     * Default endpoint for API v2
     */
    const DEFAULT_API_URL = 'https://api.pananames.com/merchant/v2/';

    /**
     * @var NameServers
     */
    public $nameServersInstance;

    /**
     * @var TransferOut
     */
    public $transferOutInstance;

    /**
     * @var TransferIn
     */
    public $transferInInstance;

    /**
     * @var Other
     */
    public $otherInstance;

    /**
     * @var Account
     */
    public $accountInstance;


    public function nameServers(): NameServers
    {
        if (!$this->nameServersInstance) {
            $this->nameServersInstance = new NameServers($this->httpClient);
        }

        return $this->nameServersInstance;
    }

    /**
     * Create and return TransferOut instance
     *
     * @return TransferOut
     */
    public function transferOut(): TransferOut
    {
        if (!$this->transferOutInstance) {
            $this->transferOutInstance = new TransferOut($this->httpClient);
        }

        return $this->transferOutInstance;
    }

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
     * @var HttpClient
     */
    public $httpClient;

    public function __construct(HttpClient $httpClient)
    {
        $this->httpClient = $httpClient;
    }
}
