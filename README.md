# Chunkify Analytics PHP API library

This is the API client for the Chunkify Analytics server. For automatic playback tracking
in a browser, use [`@chunkify/player-analytics`](https://www.npmjs.com/package/@chunkify/player-analytics).

For event ingestion, use typed event models as described in [INGESTION.md](INGESTION.md).

The Chunkify Analytics PHP library provides convenient access to the Chunkify Analytics REST API from any PHP 8.1.0+ application.

It is generated with [Stainless](https://www.stainless.com/).

## Documentation

The REST API documentation can be found on [chunkify.dev](https://chunkify.dev/docs).

## Installation

<!-- x-release-please-start-version -->

```
composer require "chunkify/chunkify-analytics-php 0.1.0"
```

<!-- x-release-please-end -->

## Usage

This library uses named parameters to specify optional arguments.
Parameters with a default value must be set by name.

```php
<?php

use ChunkifyAnalytics\Client;

$client = new Client(
  secretKey: getenv('CHUNKIFY_ANALYTICS_SECRET_KEY') ?: 'My Secret Key'
);

$metricsResponse = $client->summary->retrieve();

var_dump($metricsResponse);
```

### Value Objects

It is recommended to use the static `with` constructor `BrowserContext::with(schemaVersion: 1, ...)`
and named parameters to initialize value objects.

However, builders are also provided `(new BrowserContext)->withSchemaVersion(1)`.

### Pagination

List methods in the Chunkify Analytics API are paginated.

This library provides auto-paginating iterators with each list response, so you do not have to request successive pages manually:

```php
<?php

use ChunkifyAnalytics\Client;

$client = new Client(
  secretKey: getenv('CHUNKIFY_ANALYTICS_SECRET_KEY') ?: 'My Secret Key'
);

$page = $client->events->list();

var_dump($page);

// fetch items from the current page
foreach ($page->getItems() as $item) {
  var_dump($item->ingestKeyID);
}
// make additional network requests to fetch items from all pages, including and after the current page
foreach ($page->pagingEachItem() as $item) {
  var_dump($item->ingestKeyID);
}
```

### Handling errors

When the library is unable to connect to the API, or if the API returns a non-success status code (i.e., 4xx or 5xx response), a subclass of `ChunkifyAnalytics\Core\Exceptions\APIException` will be thrown:

```php
<?php

use ChunkifyAnalytics\Core\Exceptions\APIConnectionException;
use ChunkifyAnalytics\Core\Exceptions\RateLimitException;
use ChunkifyAnalytics\Core\Exceptions\APIStatusException;

try {
  $metricsResponse = $client->summary->retrieve();
} catch (APIConnectionException $e) {
  echo "The server could not be reached", PHP_EOL;
  var_dump($e->getPrevious());
} catch (RateLimitException $e) {
  echo "A 429 status code was received; we should back off a bit.", PHP_EOL;
} catch (APIStatusException $e) {
  echo "Another non-200-range status code was received", PHP_EOL;
  echo $e->getMessage();
}
```

Error codes are as follows:

| Cause            | Error Type                     |
| ---------------- | ------------------------------ |
| HTTP 400         | `BadRequestException`          |
| HTTP 401         | `AuthenticationException`      |
| HTTP 403         | `PermissionDeniedException`    |
| HTTP 404         | `NotFoundException`            |
| HTTP 409         | `ConflictException`            |
| HTTP 422         | `UnprocessableEntityException` |
| HTTP 429         | `RateLimitException`           |
| HTTP >= 500      | `InternalServerException`      |
| Other HTTP error | `APIStatusException`           |
| Timeout          | `APITimeoutException`          |
| Network error    | `APIConnectionException`       |

### Retries

Certain errors will be automatically retried 2 times by default, with a short exponential backoff.

Connection errors (for example, due to a network connectivity problem), 408 Request Timeout, 409 Conflict, 429 Rate Limit, >=500 Internal errors, and timeouts will all be retried by default.

You can use the `maxRetries` option to configure or disable this:

```php
<?php

use ChunkifyAnalytics\Client;

// Configure the default for all requests:
$client = new Client(requestOptions: ['maxRetries' => 0]);

// Or, configure per-request:
$result = $client->summary->retrieve(requestOptions: ['maxRetries' => 5]);
```

## Advanced concepts

### Making custom or undocumented requests

#### Undocumented properties

You can send undocumented parameters to any endpoint, and read undocumented response properties, like so:

Note: the `extra*` parameters of the same name overrides the documented parameters.

```php
<?php

$metricsResponse = $client->summary->retrieve(
  requestOptions: [
    'extraQueryParams' => ['my_query_parameter' => 'value'],
    'extraBodyParams' => ['my_body_parameter' => 'value'],
    'extraHeaders' => ['my-header' => 'value'],
  ],
);
```

#### Undocumented request params

If you want to explicitly send an extra param, you can do so with the `extra_query`, `extra_body`, and `extra_headers` under the `request_options:` parameter when making a request, as seen in the examples above.

#### Undocumented endpoints

To make requests to undocumented endpoints while retaining the benefit of auth, retries, and so on, you can make requests using `client.request`, like so:

```php
<?php

$response = $client->request(
  method: "post",
  path: '/undocumented/endpoint',
  query: ['dog' => 'woof'],
  headers: ['useful-header' => 'interesting-value'],
  body: ['hello' => 'world']
);
```

## Versioning

This package follows [SemVer](https://semver.org/spec/v2.0.0.html) conventions. As the library is in initial development and has a major version of `0`, APIs may change at any time.

This package considers improvements to the (non-runtime) PHPDoc type definitions to be non-breaking changes.

## Requirements

PHP 8.1.0 or higher.

## Contributing

See [the contributing documentation](https://github.com/chunkifydev/chunkify-analytics-php/tree/main/CONTRIBUTING.md).
