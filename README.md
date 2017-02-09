Google Api Client Wrapper
=========

> Google api php client wrapper with Cloud Platform and Laravel 4 & 5 support

## Requirements

This package requires PHP >=5.4

## Installation

Install via composer - edit your `composer.json` to require the package.

```js
"require": {
    "pmmotors/google-apiclient": "3.*"
}
```

Then run `composer update` in your terminal to pull it in.

Or use `composer require pmmotors/google-apiclient`

## Laravel

To use in laravel add the following to the `providers` array in your `config/app.php`

```php
PmMotors\Google\GoogleServiceProvider::class
```

Next add the following to the `aliases` array in your `config/app.php`

```php
'Google' => PmMotors\Google\Facades\Google::class
```

Finally run `php artisan vendor:publish --provider="PmMotors\Google\GoogleServiceProvider" --tag="config"` to publish the config file.

#### Looking for a Laravel 4 compatible version?

Checkout the [1.0 branch](https://github.com/pmmotors/google-apiclient/tree/1.0)

## Usage

The `Client` class takes an array as the first parameter, see example of config file below:

```php
<?php

return [
    /*
    |----------------------------------------------------------------------------
    | Google application name
    |----------------------------------------------------------------------------
    */
    'application_name' => env('GOOGLE_APPLICATION_NAME', ''),

    /*
    |----------------------------------------------------------------------------
    | Google OAuth 2.0 access
    |----------------------------------------------------------------------------
    |
    | Keys for OAuth 2.0 access, see the API console at
    | https://developers.google.com/console
    |
    */
    'client_id'       => env('GOOGLE_CLIENT_ID', ''),
    'client_secret'   => env('GOOGLE_CLIENT_SECRET', ''),
    'redirect_uri'    => env('GOOGLE_REDIRECT', ''),
    'scopes'          => array('https://www.googleapis.com/auth/analytics.readonly'), //[],
    'access_type'     => 'offline', //'online',
    'approval_prompt' => 'auto',
    'refresh_token'   => env('GOOGLE_REFRESH_TOKEN', ''),
    /*
    |----------------------------------------------------------------------------
    | Google developer key
    |----------------------------------------------------------------------------
    |
    | Simple API access key, also from the API console. Ensure you get
    | a Server key, and not a Browser key.
    |
    */
    'developer_key' => env('GOOGLE_DEVELOPER_KEY', ''),

    /*
    |----------------------------------------------------------------------------
    | Google service account
    |----------------------------------------------------------------------------
    |
    | Set the credentials JSON's location to use assert credentials, otherwise
    | app engine or compute engine will be used.
    |
    */
    'service' => [
        /*
        | Enable service account auth or not.
        */
        'enable' => env('GOOGLE_SERVICE_ENABLED', false),

        /*
        | Path to service account json file
        */
        'file' => env('GOOGLE_SERVICE_ACCOUNT_JSON_LOCATION', '')
    ],
];


```

To use Google Cloud Platform services, enter the location to the service account JSON file **(not the JSON string itself)**. To use App Engine or Computer Engine, leave it blank.

From [Google's upgrading document](https://github.com/google/google-api-php-client/blob/master/UPGRADING.md):

> Note: P12s are deprecated in favor of service account JSON, which can be generated in the Credentials section of Google Developer Console.


Get `Google_Client`
```php
$client = new PmMotors\Google\Client($config);
$googleClient = $client->getClient();
```

Laravel Example:
```php
$googleClient = Google::getClient();
```

Get a service
```php
$client = new PmMotors\Google\Client($config);

// returns instance of \Google_Service_Storage
$storage = $client->make('storage');

// list buckets example
$storage->buckets->listBuckets('project id');

// get object example
$storage->objects->get('bucket', 'object');
```

Laravel Example:
```php
// returns instance of \Google_Service_Storage
$storage = Google::make('storage');

// list buckets example
$storage->buckets->listBuckets('project id');

// get object example
$storage->objects->get('bucket', 'object');
```

Have a look at [google/google-api-php-client-services](https://github.com/google/google-api-php-client-services) to get a full list of the supported Google Services.
