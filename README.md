# Pananames.com API

- API version: 1.0.0


  This package introduces APIv2 for Pananames services using PHP 7.x. PHP8.x version will follow shortly.

## Requirements

PHP 7.1 - 8.1

## Installation & Usage
### Composer

To install the bindings via [Composer](http://getcomposer.org/), add the following to `composer.json`:

```
{
	"require": {
		"pananames/api2": "^1.0"
	}
}
```
or run `composer require pananames/api2`.

### Usage

```php
<?php

require_once(__DIR__ . '/vendor/autoload.php');

use Pananames\Api\Client;

// Create client
$client = Client::make('example95-8888-11e0-a7e8-04aafc84test');

try {
    // Get current balance.
    $response = $client->account()->getBalance();

    // Get paged list of domains available in your account.
    $response = $client->domains()->getList();

    // Get name server records.
    $response = $client->nameServers()->getDnsRecords('newexample.xyz');

    // Get full list of available TLDs.
    $response = $client->other()->getTlds();

    // Get current redirect URL.
    $response = $client->redirect()->getRedirect('newexample.xyz');

    // Get active transfers in.
    $response = $client->transferIn()->getTransfersList(1, 20);

    // Init transfer out.
    $response = $client->transferOut()->initTransferOut('newexample.xyz');

    // Get WHOIS information.
    $response = $client->whois()->getWhois('newexample.xyz', true);
} catch (Exception $e) {
    echo "Error: ". $e->getMessage() . "\n";
}
```

The following list introduces main Pananames entities you can use:

- Account
- Domains
- NameServers
- Other
- Redirect
- TransferIn
- TransferOut
- Whois

All the classes are fully described in `src/V2/Entities/` directory. Description of response objects can be found in `src/V2/Schemas/`
Also you can find all usage examples in `src/Examples`.

### Testing

Tests are implemented in `tests/` directory, and utilize PHPUnit and PHPStan dev dependencies.

`./vendor/bin/phpunit`

`./vendor/bin/phpstan analyse`