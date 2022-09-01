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
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Pananames\Api\Exceptions\InvalidApiResponse
     */
    public function getChildDns(string $domain): BaseResponse
    {
        $response = $this->httpClient->request($this->getChildDnsResource($domain));
        $dataContents = json_decode($response->getBody()->getContents(), true);

        $this->validate($response, $dataContents, 'NameServers/ChildDnsList');

        $dnsRecordsResponse = new BaseResponse($dataContents['data']);
        $dnsRecordsResponse->setHttpCode($response->getStatusCode());

        return $dnsRecordsResponse;
    }

    /**
     * @param string $domain
     *
     * @return string
     */
    private function getChildDnsResource(string $domain): string
    {
        return str_replace('{'.'domain'.'}', rawurlencode($domain), 'domains/{domain}/child_name_servers');
    }


    /**
     * @param string $domain
     *
     * @return BaseResponse
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Pananames\Api\Exceptions\InvalidApiResponse
     */
    public function getDnsRecords(string $domain): BaseResponse
    {
        $response = $this->httpClient->request($this->getDnsResource($domain));
        $dataContents = json_decode($response->getBody()->getContents(), true);

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
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Pananames\Api\Exceptions\InvalidApiResponse
     */
    public function createDnsRecord(string $domain, array $dnsRecords): BaseResponse
    {
        $response = $this->httpClient->request($this->getDnsResource($domain), 'POST', [], [], $dnsRecords);
        $dataContents = json_decode($response->getBody()->getContents(), true);

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
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Pananames\Api\Exceptions\InvalidApiResponse
     */
    public function updateDnsRecord(string $domain, array $dnsRecord): BaseResponse
    {
        $response = $this->httpClient->request($this->getDnsResource($domain), 'PUT', [], [], $dnsRecord);
        $dataContents = json_decode($response->getBody()->getContents(), true);

        $this->validate($response, $dataContents, 'NameServers/DnsRecord');

        $dnsRecordResponse = new BaseResponse($dataContents['data']);
        $dnsRecordResponse->setHttpCode($response->getStatusCode());

        return $dnsRecordResponse;
    }

    /**
     * @param string $domain
     * @param array $dnsRecord
     *
     * @return bool
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Pananames\Api\Exceptions\InvalidApiResponse
     */
    public function deleteDnsRecord(string $domain, array $dnsRecord): bool
    {
        $response = $this->httpClient->request($this->getDnsResource($domain), 'DELETE', [], [], $dnsRecord);
        $dataContents = $response->getBody()->getContents();

        $this->validate($response, $dataContents);

        return true;
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

    /**
     * @param string $domain
     * @param array $dnsRecords
     *
     * @return BaseResponse
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Pananames\Api\Exceptions\InvalidApiResponse
     */
    public function createBulkDnsRecords(string $domain, array $dnsRecords): BaseResponse
    {
        $response = $this->httpClient->request($this->getBulkDnsResource($domain), 'POST', [], [], ['data' => $dnsRecords]);
        $dataContents = json_decode($response->getBody()->getContents(), true);

        $this->validate($response, $dataContents, 'NameServers/DnsRecordsList');

        $dnsRecordResponse = new BaseResponse($dataContents['data']);
        $dnsRecordResponse->setHttpCode($response->getStatusCode());

        return $dnsRecordResponse;
    }

    /**
     * @param string $domain
     * @param array $dnsRecords
     *
     * @return BaseResponse
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Pananames\Api\Exceptions\InvalidApiResponse
     */
    public function updateBulkDnsRecords(string $domain, array $dnsRecords): BaseResponse
    {
        $response = $this->httpClient->request($this->getBulkDnsResource($domain), 'PUT', [], [], ['data' => $dnsRecords]);
        $dataContents = json_decode($response->getBody()->getContents(), true);

        $this->validate($response, $dataContents, 'NameServers/DnsRecordsList');

        $dnsRecordResponse = new BaseResponse($dataContents['data']);
        $dnsRecordResponse->setHttpCode($response->getStatusCode());

        return $dnsRecordResponse;
    }

    /**
     * @param string $domain
     *
     * @return string
     */
    private function getBulkDnsResource(string $domain): string
    {
        return str_replace('{'.'domain'.'}', rawurlencode($domain), 'domains/{domain}/bulk_name_server_records');
    }
}
