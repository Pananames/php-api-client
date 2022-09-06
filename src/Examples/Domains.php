<?php

require_once(__DIR__ . '/vendor/autoload.php');

use Pananames\Api\Client;

// Create client
$client = Client::make('example95-8888-11e0-a7e8-04aafc84test');

try {
    // Get paged list of domains available in your account.
    $response = $client->domains()->getList();
    echo "Response: " . print_r($response, true) . "\n";
    echo "Data: " . print_r($response->getData(), true) . "\n";

    // Register a domain name.
    $domainData = [
        "domain" => "newexamplefor.xyz",
        "period" => 1,
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
            "phone" => "+1.8075313444",
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
            "phone" => "+1.8075313444",
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
            "phone" => "+1.8075313444",
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
            "phone" => "+1.8075313444",
            "extras" => []
        ],
        "premium_price" => 0,
        "claims_accepted" => false,
        "add_req_accepted" => false
    ];

    $response = $client->domains()->register($domainData);
    echo "Response: " . print_r($response, true) . "\n";
    echo "Data: " . print_r($response->getData(), true) . "\n";

    // Get information about the domain.
    $response = $client->domains()->getInfo('newexamplefor.xyz');
    echo "Response: " . print_r($response, true) . "\n";
    echo "Data: " . print_r($response->getData(), true) . "\n";

    // Delete domain.
    $response = $client->domains()->delete('newexamplefor.xyz');
    echo "Response: " . print_r($response, true) . "\n";

    // Check domain availability and pricing.
    $response = $client->domains()->check('checkname.com');
    echo "Response: " . print_r($response, true) . "\n";
    echo "Data: " . print_r($response->getData(), true) . "\n";

    // Bulk check the domains availability.
    $arrDomains = ['firstname.xyz', 'secondname.in', 'thirdname.com'];

    $response = $client->domains()->bulkCheck($arrDomains);
    echo "Response: " . print_r($response, true) . "\n";
    echo "Data: " . print_r($response->getData(), true) . "\n";

    // Get Registration Notices for TLDs.
    $response = $client->domains()->getAddReq('examplename.app');
    echo "Response: " . print_r($response, true) . "\n";
    echo "Data: " . print_r($response->getData(), true) . "\n";

    // Get claim information.
    $response = $client->domains()->getClaim('testvalidate.xyz');
    echo "Response: " . print_r($response, true) . "\n";
    echo "Data: " . print_r($response->getData(), true) . "\n";

    // Get status codes.
    $response = $client->domains()->getStatusCodes('newexample.com');
    echo "Response: " . print_r($response, true) . "\n";
    echo "Data: " . print_r($response->getData(), true) . "\n";

    // Enable auto renew.
    $response = $client->domains()->enableAutoRenew('newexample.xyz');
    echo "Response: " . print_r($response, true) . "\n";
    echo "Data: " . print_r($response->getData(), true) . "\n";

    // Disable auto renew.
    $response = $client->domains()->disableAutoRenew('newexample.xyz');
    echo "Response: " . print_r($response, true) . "\n";
    echo "Data: " . print_r($response->getData(), true) . "\n";

    // Renew the domain
    $renewData = [
        'period' => 1,
        'premium_price' => 0,
    ];

    $response = $client->domains()->renew('newexample.com', $renewData);
    echo "Response: " . print_r($response, true) . "\n";
    echo "Data: " . print_r($response->getData(), true) . "\n";

    // Restore domain.
    $response = $client->domains()->redeem('newexample.xyz');
    echo "Response: " . print_r($response, true) . "\n";
    echo "Data: " . print_r($response->getData(), true) . "\n";

    // Resend email.
    $response = $client->domains()->resend('newexample.com');
    echo "Response: " . print_r($response, true) . "\n";
} catch (Exception $e) {
    echo "Error: ". $e->getMessage() . "\n";
}
