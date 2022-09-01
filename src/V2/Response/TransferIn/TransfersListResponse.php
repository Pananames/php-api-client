<?php

namespace Pananames\Api\V2\Response\TransferIn;

use Pananames\Api\V2\Response\BaseResponse;

class TransfersListResponse extends BaseResponse
{
    private array $meta;

    public function getMeta(): array
    {
        return $this->meta;
    }

    /**
     * @param array $meta
     * @return $this
     */
    public function setMeta(array $meta): self
    {
        $this->meta = $meta;

        return $this;
    }
}
