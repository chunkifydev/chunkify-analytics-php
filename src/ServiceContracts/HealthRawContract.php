<?php

declare(strict_types=1);

namespace ChunkifyAnalytics\ServiceContracts;

use ChunkifyAnalytics\Core\Contracts\BaseResponse;
use ChunkifyAnalytics\Core\Exceptions\APIException;
use ChunkifyAnalytics\Health\Health;
use ChunkifyAnalytics\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \ChunkifyAnalytics\RequestOptions
 */
interface HealthRawContract
{
    /**
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Health>
     *
     * @throws APIException
     */
    public function retrieve(
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse;
}
