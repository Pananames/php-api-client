<?php

namespace Pananames\Api\V2\Response;

use InvalidArgumentException;

class BaseResponse
{
    /**
     * Associative array for storing property values
     */
    protected array $data = [];

    public int $httpCode;

    public function __construct(array $data = null)
    {
        $this->setData($data);
    }

    public function setHttpCode(int $code): bool
    {
        if (empty($code)) {
            throw new InvalidArgumentException('Invalid HttpCode');
        }

        return $this->httpCode = $code;
    }

    public function getData(): array
    {
        return $this->data;
    }

    public function setData(array $data): self
    {
        $this->data = $data;

        return $this;
    }

    public function getHttpCode(): int
    {
        return $this->httpCode;
    }

    public function isSuccessful(): bool
    {
        $httpCode = $this->getHttpCode();

        if ($httpCode < 200 || $httpCode >= 300) {
            return false;
        }

        if ($httpCode != 204 && is_null($this->getData())) {
            return false;
        }

        return true;
    }

    public function hasErrors(): bool
    {
        return !$this->isSuccessful();
    }
}
