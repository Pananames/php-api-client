<?php

namespace Pananames\Api\V2\Response;

class MetaResponse extends BaseResponse
{
    /**
     * @var array<string, int>
     */
    private array $meta;

    /**
     * @return array<string, int>
     */
    public function getMeta(): array
    {
        return $this->meta;
    }

    /**
     * @param array<string, int> $meta
     *
     * @return $this
     */
    public function setMeta(array $meta): self
    {
        $this->meta = $meta;

        return $this;
    }
}
