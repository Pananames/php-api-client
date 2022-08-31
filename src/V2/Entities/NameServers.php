<?php

namespace Pananames\Api\V2\Entities;

use Pananames\Api\V2\Response\BaseResponse;

class NameServers extends Entity
{
    public function getDnsRecords(string $domain): BaseResponse
    {
        $response = $this->httpClient->request($this->getResource($domain));
        $dataContents = json_decode($response->getBody()->getContents(), 1);

        $this->validate($response, $dataContents, 'NameServers/DnsRecordsList');

        $nameServersResponse = new BaseResponse($dataContents['data']);
        $nameServersResponse->setHttpCode($response->getStatusCode());

        return $nameServersResponse;
    }

    /**
     * @param string $domain
     *
     * @return string
     */
    private function getResource(string $domain): string
    {
        return str_replace('{'.'domain'.'}', rawurlencode($domain), 'domains/{domain}/name_server_records');
    }
}
