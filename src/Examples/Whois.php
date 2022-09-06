<?php

require_once(__DIR__ . '/vendor/autoload.php');

use Pananames\Api\Client;

// Create client
$client = Client::make('example95-8888-11e0-a7e8-04aafc84test');

try {
    // Get WHOIS information.
    $response = $client->whois()->getWhois('newexample.xyz', true);
    echo "Response: " . print_r($response, true) . "\n";
    echo "Data: " . print_r($response->getData(), true) . "\n";
    
    // Set WHOIS information.
    $whoisInfo = [
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
        ]
    ];

    $response = $client->whois()->setWhois('newexample.xyz', $whoisInfo);
    echo "Response: " . print_r($response, true) . "\n";
    echo "Data: " . print_r($response->getData(), true) . "\n";

    // Get WHOIS privacy status.
    $response = $client->whois()->getWhoisPrivacy('newexample.xyz');
    echo "Response: " . print_r($response, true) . "\n";
    echo "Data: " . print_r($response->getData(), true) . "\n";

    // Enable WHOIS privacy.
    $response = $client->whois()->enableWhoisPrivacy('newexample.xyz');
    echo "Response: " . print_r($response, true) . "\n";
    echo "Data: " . print_r($response->getData(), true) . "\n";

    // Disable WHOIS privacy.
    $response = $client->whois()->disableWhoisPrivacy('newexample.xyz');
    echo "Response: " . print_r($response, true) . "\n";
    echo "Data: " . print_r($response->getData(), true) . "\n";
} catch (Exception $e) {
    echo "Error: ". $e->getMessage() . "\n";
}
