<?php

namespace Pananames\Api\V2\Response\TransferIn;

use Pananames\Api\V2\Response\BaseResponse;

class TransferInResponse extends BaseResponse
{
    private array $meta;

    public function getMeta(): array
    {
        return $this->meta;
    }

    public function setMeta($meta): self
    {
        $this->meta = $meta;

        return $this;
    }
}
