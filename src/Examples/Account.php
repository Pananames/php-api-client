<?php

require_once(__DIR__ . '/vendor/autoload.php');

use Pananames\Api\Client;

// Create client
$client = Client::make('example95-8888-11e0-a7e8-04aafc84test');

try {
    // Get current balance.
    $response = $client->account()->getBalance();
    echo "Response: " . print_r($response, true) . "\n";
    echo "Data: " . print_r($response->getData(), true) . "\n";

    // Get paged list of your payments.
    $response = $client->account()->getPayments(1, 20, null, 'create', 'host');
    echo "Response: " . print_r($response, true) . "\n";
    echo "Data: " . print_r($response->getData(), true) . "\n";
    echo "Meta: " . print_r($response->getMeta(), true) . "\n";
} catch (Exception $e) {
    echo "Error: ". $e->getMessage() . "\n";
}
