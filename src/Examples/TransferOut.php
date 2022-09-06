<?php

require_once(__DIR__ . '/vendor/autoload.php');

use Pananames\Api\Client;

// Create client
$client = Client::make('example95-8888-11e0-a7e8-04aafc84test');

try {
    // Init transfer out.
    $response = $client->transferOut()->initTransferOut('newexample.xyz');
    echo "Response: " . print_r($response, true) . "\n";

    // Cancel transfer out.
    $response = $client->transferOut()->cancelTransferOut('newexample.xyz');
    echo "Transfer: " . print_r($response, 1) . "\n";
} catch (Exception $e) {
    echo "Error: ". $e->getMessage() . "\n";
}