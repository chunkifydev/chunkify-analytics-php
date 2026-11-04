<?php

declare(strict_types=1);

namespace ChunkifyAnalytics\ServiceContracts;

use ChunkifyAnalytics\Core\Contracts\BaseResponse;
use ChunkifyAnalytics\Core\Exceptions\APIException;
use ChunkifyAnalytics\RequestOptions;
use ChunkifyAnalytics\Retention\RetentionReport;
use ChunkifyAnalytics\Retention\RetentionRetrieveParams;

/**
 * @phpstan-import-type RequestOpts from \ChunkifyAnalytics\RequestOptions
 */
interface RetentionRawContract
{
    /**
     * @api
     *
     * @param array<string,mixed>|RetentionRetrieveParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<RetentionReport>
     *
     * @throws APIException
     */
    public function retrieve(
        array|RetentionRetrieveParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}
