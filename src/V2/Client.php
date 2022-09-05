<?php

namespace Pananames\Api\V2;

use Pananames\Api\V2\Entities\Account;
use Pananames\Api\V2\Entities\NameServers;
use Pananames\Api\V2\Entities\Other;
use Pananames\Api\V2\Entities\Redirect;
use Pananames\Api\V2\Entities\TransferIn;
use Pananames\Api\V2\Entities\TransferOut;
use Pananames\Api\V2\Entities\Whois;
use Pananames\Api\V2\HttpClients\Guzzle;

class Client
{
    /**
     * Default endpoint for API v2
     */
    const DEFAULT_API_URL = 'https://api.pananames.com/merchant/v2/';

    /**
     * @var Whois
     */
    public $whoisInstance;

    /**
     * @var Redirect
     */
    public $redirectInstance;

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

    /**
     * @var Guzzle
     */
    public Guzzle $httpClient;

    public function __construct(Guzzle $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    public function whois(): Whois
    {
        if (!is_object($this->whoisInstance)) {
            $this->whoisInstance = new Whois($this->httpClient);
        }

        return $this->whoisInstance;
    }

    public function redirect(): Redirect
    {
        if (!is_object($this->redirectInstance)) {
            $this->redirectInstance = new Redirect($this->httpClient);
        }

        return $this->redirectInstance;
    }


    public function nameServers(): NameServers
    {
        if (!is_object($this->nameServersInstance)) {
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
        if (!is_object($this->transferOutInstance)) {
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
        if (!is_object($this->transferInInstance)) {
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
        if (!is_object($this->otherInstance)) {
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
        if (!is_object($this->accountInstance)) {
            $this->accountInstance = new Account($this->httpClient);
        }

        return $this->accountInstance;
    }
}
