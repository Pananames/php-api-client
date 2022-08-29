<?php

namespace Pananames\Api\V2\Response\Other;

use Pananames\Api\V2\Response\BaseResponse;

class EmailsResponse extends BaseResponse
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
