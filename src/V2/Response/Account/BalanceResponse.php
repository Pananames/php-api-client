<?php

namespace Pananames\Api\V2\Response\Account;

use Pananames\Api\V2\Response\BaseResponse;

class BalanceResponse extends BaseResponse
{
    private float $balance;
    /**
     * @return float|null
     */
    public function getBalance(): ?float
    {
        return $this->balance;
    }

    /**
     * Sets balance
     * @param float $balance
     * @return $this
     */
    public function setBalance(float $balance): self
    {
        $this->balance = $balance;

        return $this;
    }
}
