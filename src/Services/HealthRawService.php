<?php

declare(strict_types=1);

namespace ChunkifyAnalytics\Services;

use ChunkifyAnalytics\Client;
use ChunkifyAnalytics\Core\Contracts\BaseResponse;
use ChunkifyAnalytics\Core\Exceptions\APIException;
use ChunkifyAnalytics\Health\Health;
use ChunkifyAnalytics\RequestOptions;
use ChunkifyAnalytics\ServiceContracts\HealthRawContract;

/**
 * Health and private ingestion status.
 *
 * @phpstan-import-type RequestOpts from \ChunkifyAnalytics\RequestOptions
 */
final class HealthRawService implements HealthRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Check whether the service is ready.
     *
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Health>
     *
     * @throws APIException
     */
    public function retrieve(
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'healthz',
            options: $requestOptions,
            convert: Health::class,
            security: [],
        );
    }
}
