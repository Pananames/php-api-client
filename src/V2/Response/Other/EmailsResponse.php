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

    /**
     * @param array $meta
     *
     * @return $this
     */
    public function setMeta(array $meta): self
    {
        $this->meta = $meta;

        return $this;
    }
}
