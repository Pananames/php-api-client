<?php

require_once(__DIR__ . '/vendor/autoload.php');

use Pananames\Api\Client;

// Create client
$client = Client::make('example95-8888-11e0-a7e8-04aafc84test');

try {
    // Get active transfers in.
    $response = $client->transferIn()->getTransfersList(1, 20);
    echo "Response: " . print_r($response, true) . "\n";
    echo "Data: " . print_r($response->getData(), true) . "\n";

    // Init transfers in.
    $data = [
        "domain" => "example.com",
        "auth_code" => "sectauth2s",
        "premium_price" => 0,
        "whois_privacy" => true,
        "registrant_contact" => [
            "org" => "Fozzy",
            "name" => "Logika",
            "email" => "qwingt@gmail.com",
            "address" => "ul. Rhylova 8",
            "city" => "Poling",
            "state" => "LV",
            "zip" => "75333",
            "country" => "DE",
            "phone" => "+1.9175313444",
            "extras" => []
        ],
        "admin_contact" => [
            "org" => "Fozzy",
            "name" => "Logika",
            "email" => "qwingt@gmail.com",
            "address" => "ul. Rhylova 8",
            "city" => "Poling",
            "state" => "LV",
            "zip" => "75333",
            "country" => "DE",
            "phone" => "+1.9175313444",
            "extras" => []
        ],
        "tech_contact" => [
            "org" => "Fozzy",
            "name" => "Logika",
            "email" => "qwingt@gmail.com",
            "address" => "ul. Rhylova 8",
            "city" => "Poling",
            "state" => "LV",
            "zip" => "75333",
            "country" => "DE",
            "phone" => "+1.9175313444",
            "extras" => []
        ],
        "billing_contact" => [
            "org" => "Fozzy",
            "name" => "Logika",
            "email" => "qwingt@gmail.com",
            "address" => "ul. Rhylova 8",
            "city" => "Poling",
            "state" => "LV",
            "zip" => "75333",
            "country" => "DE",
            "phone" => "+1.9175313444",
            "extras" => []
        ],
        "name_servers" => [
            "ns1.fozzy.com",
            "ns1.fozzy.com"
        ],
        "name_server_records" => [
            [
                "id" => "string",
                "name" => "string",
                "type" => "A",
                "value" => "string",
                "priority" => 0,
                "ttl" => 0
            ]
        ]
    ];

    $response = $client->transferIn()->initTransfetIn($data);
    echo "Response: " . print_r($response, true) . "\n";
    echo "Data: " . print_r($response->getData(), true) . "\n";

    // Cancel transfers in.
    $response = $client->transferIn()->cancel('newexample.xyz');
    echo "Response: " . print_r($response, true) . "\n";
} catch (Exception $e) {
    echo "Error: ". $e->getMessage() . "\n";
}
