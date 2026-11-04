<?php

declare(strict_types=1);

namespace ChunkifyAnalytics\ServiceContracts;

use ChunkifyAnalytics\Core\Contracts\BaseResponse;
use ChunkifyAnalytics\Core\Exceptions\APIException;
use ChunkifyAnalytics\RequestOptions;
use ChunkifyAnalytics\Summary\Metrics;
use ChunkifyAnalytics\Summary\MetricsBreakdownPage;
use ChunkifyAnalytics\Summary\SummaryRetrieveParams;

/**
 * @phpstan-import-type RequestOpts from \ChunkifyAnalytics\RequestOptions
 */
interface SummaryRawContract
{
    /**
     * @api
     *
     * @param array<string,mixed>|SummaryRetrieveParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Metrics|MetricsBreakdownPage>
     *
     * @throws APIException
     */
    public function retrieve(
        array|SummaryRetrieveParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}
