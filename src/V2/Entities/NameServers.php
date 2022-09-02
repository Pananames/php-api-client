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
    public function getDnsServers(string $domain): BaseResponse
    {
        $response = $this->httpClient->request($this->getDnsServersResource($domain));
        $dataContents = json_decode($response->getBody()->getContents(), true);

        $this->validate($response, $dataContents, 'NameServers/DnsServersList');

        $dnsServersResponse = new BaseResponse($dataContents['data']);
        $dnsServersResponse->setHttpCode($response->getStatusCode());

        return $dnsServersResponse;
    }

    /**
     * @param string $domain
     * @param string[] $nameServers
     *
     * @return BaseResponse
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Pananames\Api\Exceptions\InvalidApiResponse
     */
    public function setDnsServers(string $domain, array $nameServers): BaseResponse
    {
        $response = $this->httpClient->request(
            $this->getDnsServersResource($domain),
            'PUT',
            [],
            [],
            ['name_servers' => $nameServers]
        );
        $dataContents = json_decode($response->getBody()->getContents(), true);

        $this->validate($response, $dataContents, 'NameServers/DnsServersList');

        $dnsRecordsResponse = new BaseResponse($dataContents['data']);
        $dnsRecordsResponse->setHttpCode($response->getStatusCode());

        return $dnsRecordsResponse;
    }

    /**
     * @param string $domain
     *
     * @return bool
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Pananames\Api\Exceptions\InvalidApiResponse
     */
    public function deleteDnsServers(string $domain): bool
    {
        $response = $this->httpClient->request($this->getDnsServersResource($domain), 'DELETE');
        $dataContents = $response->getBody()->getContents();

        $this->validate($response, $dataContents);

        return true;
    }

    /**
     * @param string $domain
     *
     * @return string
     */
    private function getDnsServersResource(string $domain): string
    {
        return str_replace('{'.'domain'.'}', rawurlencode($domain), 'domains/{domain}/name_servers');
    }

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
     * @param array $childDns
     *
     * @return BaseResponse
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Pananames\Api\Exceptions\InvalidApiResponse
     */
    public function updateChildDns(string $domain, array $childDns): BaseResponse
    {
        $response = $this->httpClient->request($this->getChildDnsResource($domain), 'PUT', [], [], $childDns);
        $dataContents = json_decode($response->getBody()->getContents(), true);

        $this->validate($response, $dataContents, 'NameServers/ChildDns');

        $dnsRecordsResponse = new BaseResponse($dataContents['data']);
        $dnsRecordsResponse->setHttpCode($response->getStatusCode());

        return $dnsRecordsResponse;
    }

    /**
     * @param string $domain
     * @param array $childDns
     *
     * @return BaseResponse
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Pananames\Api\Exceptions\InvalidApiResponse
     */
    public function createChildDns(string $domain, array $childDns): BaseResponse
    {
        $response = $this->httpClient->request($this->getChildDnsResource($domain), 'POST', [], [], $childDns);
        $dataContents = json_decode($response->getBody()->getContents(), true);

        $this->validate($response, $dataContents, 'NameServers/ChildDns');

        $dnsRecordsResponse = new BaseResponse($dataContents['data']);
        $dnsRecordsResponse->setHttpCode($response->getStatusCode());

        return $dnsRecordsResponse;
    }

    /**
     * @param string $domain
     * @param array $childDns
     *
     * @return bool
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Pananames\Api\Exceptions\InvalidApiResponse
     */
    public function deleteChildDns(string $domain, array $childDns): bool
    {
        $response = $this->httpClient->request($this->getChildDnsResource($domain), 'DELETE', [], [], $childDns);
        $dataContents = $response->getBody()->getContents();

        $this->validate($response, $dataContents);

        return true;
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

    /**
     * @param string $domain
     *
     * @return BaseResponse
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Pananames\Api\Exceptions\InvalidApiResponse
     */
    public function getDnsSec(string $domain): BaseResponse
    {
        $response = $this->httpClient->request($this->getDnsSecResource($domain));
        $dataContents = json_decode($response->getBody()->getContents(), true);

        $this->validate($response, $dataContents, 'NameServers/DnsSec');

        $dnsSecResponse = new BaseResponse($dataContents['data']);
        $dnsSecResponse->setHttpCode($response->getStatusCode());

        return $dnsSecResponse;
    }

    /**
     * @param string $domain
     * @param string $dsData
     *
     * @return BaseResponse
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Pananames\Api\Exceptions\InvalidApiResponse
     */
    public function setDnsSec(string $domain, string $dsData): BaseResponse
    {
        $response = $this->httpClient->request($this->getDnsSecResource($domain), 'PUT', [], [], ['ds' => $dsData]);
        $dataContents = json_decode($response->getBody()->getContents(), true);

        $this->validate($response, $dataContents, 'NameServers/DnsSec');

        $dnsSecResponse = new BaseResponse($dataContents['data']);
        $dnsSecResponse->setHttpCode($response->getStatusCode());

        return $dnsSecResponse;
    }

    /**
     * @param string $domain
     *
     * @return bool
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Pananames\Api\Exceptions\InvalidApiResponse
     */
    public function deleteDnsSec(string $domain): bool
    {
        $response = $this->httpClient->request($this->getDnsSecResource($domain), 'DELETE');
        $dataContents = $response->getBody()->getContents();

        $this->validate($response, $dataContents);

        return true;
    }

    /**
     * @param string $domain
     *
     * @return string
     */
    private function getDnsSecResource(string $domain): string
    {
        return str_replace('{'.'domain'.'}', rawurlencode($domain), 'domains/{domain}/dnssec');
    }
}
