<?php

require_once(__DIR__ . '/vendor/autoload.php');

use Pananames\Api\Client;

// Create client
$client = Client::make('example95-8888-11e0-a7e8-04aafc84test');

try {
    // Get current redirect URL.
    $response = $client->redirect()->getRedirect('newexample.xyz');
    echo "Response: " . print_r($response, true) . "\n";
    echo "Data: " . print_r($response->getData(), true) . "\n";

    // Enable redirect.
    $redData = [
        'url' => 'https://redirectexample.com',
        'masking_enabled' => true,
        'masking_title' => 'Title for mask',
        'masking_desc' => 'Desc for mask',
        'masking_kwd' => 'Keywords for mask',
    ];

    $response = $client->redirect()->enable('newexample.com', $redData);
    echo "Response: " . print_r($response, true) . "\n";
    echo "Data: " . print_r($response->getData(), true) . "\n";

    // Disable redirect.
    $response = $client->redirect()->disable('newexample.xyz');
    echo "Response: " . print_r($response, true) . "\n";

    // Bulk redirect domains.
    $redirects = [
        'domain_list' => ['newexample.xyz', 'secondexample.xyz'],
        'url' => 'https://bulkredircturl.com',
        'masking_enabled' => true,
        'masking_title' => 'Title for mask',
        'masking_desc' => 'Desc for mask',
        'masking_kwd' => 'Keywords for mask',
    ];

    $response = $client->redirect()->bulkRedirect($redirects);
    echo "DnsSec: " . print_r($response, true) . "\n";
    echo "Data: " . print_r($response->getData(), true) . "\n";
} catch (Exception $e) {
    echo "Error: ". $e->getMessage() . "\n";
}
