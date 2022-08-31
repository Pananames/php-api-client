<?php

namespace Pananames\Api\V2\Entities;

class TransferOut extends Entity
{
    /**
     * @param string $domain
     *
     * @return bool
     *
     * @throws \Pananames\Api\Exceptions\InvalidApiResponse
     */
    public function initTransferOut(string $domain): bool
    {
        $response = $this->httpClient->request($this->getResource($domain), 'PUT');
        $dataContents = $response->getBody()->getContents();
        $this->validate($response, $dataContents);

        return true;
    }

    /**
     * @param string $domain
     *
     * @return bool
     *
     * @throws \Pananames\Api\Exceptions\InvalidApiResponse
     */
    public function cancelTransferOut(string $domain): bool
    {
        $response = $this->httpClient->request($this->getResource($domain), 'DELETE');
        $dataContents = $response->getBody()->getContents();
        $this->validate($response, $dataContents);

        return true;
    }

    /**
     * @param string $domain
     *
     * @return string
     */
    private function getResource(string $domain): string
    {
        return str_replace('{'.'domain'.'}', rawurlencode($domain), 'domains/{domain}/transfer_out');
    }
}
