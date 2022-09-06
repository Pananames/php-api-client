<?php

require_once(__DIR__ . '/vendor/autoload.php');

use Pananames\Api\Client;

// Create client
$client = Client::make('example95-8888-11e0-a7e8-04aafc84test');

try {
    // Get name servers.
    $response = $client->nameServers()->getDnsServers('newexample.xyz');
    echo "Response: " . print_r($response, true) . "\n";
    echo "Data: " . print_r($response->getData(), true) . "\n";

    // Set name servers.
    $nameServersList = [
        'ns1.fozzy.com',
        'ns2.fozzy.com',
    ];

    $response = $client->nameServers()->setDnsServers('newexample.xyz', $nameServersList);
    echo "Response: " . print_r($response, true) . "\n";
    echo "Data: " . print_r($response->getData(), true) . "\n";

    // Delete name servers.
    $response = $client->nameServers()->deleteDnsServers('newexample.xyz');
    echo "Response: " . print_r($response, true) . "\n";

    // Get child name servers.
    $response = $client->nameServers()->getChildDns('newexample.xyz');
    echo "Response: " . print_r($response, true) . "\n";
    echo "Data: " . print_r($response->getData(), true) . "\n";

    // Update existing child name server.
    $childDns = [
        'hostname' => 'api',
        'ipv4' => '193.0.3.3'
    ];

    $response = $client->nameServers()->updateChildDns('newexample.xyz', $childDns);
    echo "Response: " . print_r($response, true) . "\n";
    echo "Data: " . print_r($response->getData(), true) . "\n";

    // Create new child name server.
    $childDnsPost = [
        'hostname' => 'new',
        'ipv4' => '195.0.5.5'
    ];

    $response = $client->nameServers()->createChildDns('newexample.xyz', $childDnsPost);
    echo "Response: " . print_r($response, true) . "\n";
    echo "Data: " . print_r($response->getData(), true) . "\n";

    // Delete child name server.
    $childDnsDel = [
        'hostname' => 'new'
    ];

    $response = $client->nameServers()->deleteChildDns('newexample.xyz', $childDnsDel);
    echo "Response: " . print_r($response, true) . "\n";

    // Get name server records.
    $response = $client->nameServers()->getDnsRecords('newexample.xyz');
    echo "Response: " . print_r($response, true) . "\n";
    echo "Data: " . print_r($response->getData(), true) . "\n";

    // Create new name server record.
    $dnsRecord = [
        "id" => "",
        "name" => "",
        "type" => "NS",
        "value" => "ns3.fozzy.com.",
        "priority" => 0,
        "ttl" => 300
    ];
    $response = $client->nameServers()->createDnsRecord('newexample.xyz', $dnsRecord);
    echo "Response: " . print_r($response, true) . "\n";
    echo "Data: " . print_r($response->getData(), true) . "\n";

    // Update existing name server record.
    $dnsRecordUp = [
        "id" => "868e0d4f87648e51a8f43f69958bcb63",
        "name" => "",
        "type" => "NS",
        "value" => "ns3.bodis.com.",
        "priority" => 0,
        "ttl" => 300
    ];

    $response = $client->nameServers()->updateDnsRecord('newexample.xyz', $dnsRecordUp);
    echo "Response: " . print_r($response, true) . "\n";
    echo "Data: " . print_r($response->getData(), true) . "\n";

    // Delete name server record.
    $dnsRecordDel = [
        "id" => "ac63e869b03b376b78a664296ca9de95",
    ];

    $response = $client->nameServers()->deleteDnsRecord('newexample.xyz', $dnsRecordDel);
    echo "Response: " . print_r($response, true) . "\n";

    // Create list of new name server records.
    $dnsRecords = [
        [
            "id" => "",
            "name" => "",
            "type" => "NS",
            "value" => "ns4.fozzy.com.",
            "priority" => 0,
            "ttl" => 300
        ],
        [
            "id" => "",
            "name" => "",
            "type" => "NS",
            "value" => "ns5.fozzy.com.",
            "priority" => 0,
            "ttl" => 300
        ]
    ];

    $response = $client->nameServers()->createBulkDnsRecords('newexample.xyz', $dnsRecords);
    echo "Response: " . print_r($response, true) . "\n";
    echo "Data: " . print_r($response->getData(), true) . "\n";

    // Update list of existing name server records.
    $dnsRecordsUp = [
        [
            "id" => "ac63e869b03b376b78a664296ca9de95",
            "name" => "",
            "type" => "NS",
            "value" => "ns1.bodis.com.",
            "priority" => 0,
            "ttl" => 300
        ],
        [
            "id" => "364367b244a9410210f538d8ffb9405d",
            "name" => "",
            "type" => "NS",
            "value" => "ns2.bodis.com.",
            "priority" => 0,
            "ttl" => 300
        ]
    ];

    $response = $client->nameServers()->updateBulkDnsRecords('newexample.xyz', $dnsRecordsUp);
    echo "Response: " . print_r($response, true) . "\n";
    echo "Data: " . print_r($response->getData(), true) . "\n";

    // Get DNSSec status.
    $response = $client->nameServers()->getDnsSec('newexample.xyz');
    echo "Response: " . print_r($response, true) . "\n";
    echo "Data: " . print_r($response->getData(), true) . "\n";

    // Enable DNSSec.
    $dsData = '44335 13 4 examplea46a2d0e26b63473890b247a1f7de56c533b2400517777744d05efded8f4bdc47dcf2c39a3d0c9a82c745ctest';
    $response = $client->nameServers()->setDnsSec('newexample.xyz', $dsData);
    echo "Response: " . print_r($response, true) . "\n";
    echo "Data: " . print_r($response->getData(), true) . "\n";

    $response = $client->nameServers()->setDnsSec('secondexample.xyz', '');
    echo "Response: " . print_r($response, true) . "\n";
    echo "Data: " . print_r($response->getData(), true) . "\n";

    // Disable DNSSec.
    $response = $client->nameServers()->deleteDnsSec('newexample.xyz');
    echo "Response: " . print_r($response, true) . "\n";

    // Get DNSSec status flag.
    $response = $client->nameServers()->getEnabledDnsSecFlag('newexample.xyz');
    echo "Response: " . print_r($response, true) . "\n";
    echo "Data: " . print_r($response->getData(), true) . "\n";
} catch (Exception $e) {
    echo "Error: ". $e->getMessage() . "\n";
}