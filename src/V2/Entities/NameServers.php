<?php

namespace Pananames\Api\V2\Entities;

use Pananames\Api\V2\Response\BaseResponse;

class NameServers extends Entity
{
    /**
     * @param string $domain
     *
     * @return BaseResponse
     *
     * @throws \Pananames\Api\Exceptions\InvalidApiResponse
     */
    public function getDnsRecords(string $domain): BaseResponse
    {
        $response = $this->httpClient->request($this->getDnsResource($domain));
        $dataContents = json_decode($response->getBody()->getContents(), 1);

        $this->validate($response, $dataContents, 'NameServers/DnsRecordsList');

        $dnsRecordsResponse = new BaseResponse($dataContents['data']);
        $dnsRecordsResponse->setHttpCode($response->getStatusCode());

        return $dnsRecordsResponse;
    }

    /**
     * @param string $domain
     * @param array $dnsRecords
     *
     * @return BaseResponse
     *
     * @throws \Pananames\Api\Exceptions\InvalidApiResponse
     */
    public function createDnsRecord(string $domain, array $dnsRecords): BaseResponse
    {
        $response = $this->httpClient->request($this->getDnsResource($domain), 'POST', [], [], $dnsRecords);
        $dataContents = json_decode($response->getBody()->getContents(), 1);

        $this->validate($response, $dataContents, 'NameServers/DnsRecord');

        $dnsRecordResponse = new BaseResponse($dataContents['data']);
        $dnsRecordResponse->setHttpCode($response->getStatusCode());

        return $dnsRecordResponse;
    }

    /**
     * @param string $domain
     * @param array $dnsRecord
     *
     * @return BaseResponse
     *
     * @throws \Pananames\Api\Exceptions\InvalidApiResponse
     */
    public function updateDnsRecord(string $domain, array $dnsRecord): BaseResponse
    {
        $response = $this->httpClient->request($this->getDnsResource($domain), 'PUT', [], [], $dnsRecord);
        $dataContents = json_decode($response->getBody()->getContents(), 1);

        $this->validate($response, $dataContents, 'NameServers/DnsRecord');

        $dnsRecordResponse = new BaseResponse($dataContents['data']);
        $dnsRecordResponse->setHttpCode($response->getStatusCode());

        return $dnsRecordResponse;
    }

    /**
     * @param string $domain
     *
     * @return string
     */
    private function getDnsResource(string $domain): string
    {
        return str_replace('{'.'domain'.'}', rawurlencode($domain), 'domains/{domain}/name_server_records');
    }
}
