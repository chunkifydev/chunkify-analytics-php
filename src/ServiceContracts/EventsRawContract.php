<?php

declare(strict_types=1);

namespace ChunkifyAnalytics\ServiceContracts;

use ChunkifyAnalytics\Core\Contracts\BaseResponse;
use ChunkifyAnalytics\Core\Exceptions\APIException;
use ChunkifyAnalytics\Events\EventIngestParams;
use ChunkifyAnalytics\Events\EventListParams;
use ChunkifyAnalytics\Events\NativeCreated;
use ChunkifyAnalytics\Events\NativeDuplicate;
use ChunkifyAnalytics\Events\StoredEvent;
use ChunkifyAnalytics\EventsPage;
use ChunkifyAnalytics\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \ChunkifyAnalytics\RequestOptions
 */
interface EventsRawContract
{
    /**
     * @api
     *
     * @param array<string,mixed>|EventListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<EventsPage<StoredEvent>>
     *
     * @throws APIException
     */
    public function list(
        array|EventListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|EventIngestParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<NativeCreated|NativeDuplicate>
     *
     * @throws APIException
     */
    public function ingest(
        array|EventIngestParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}
