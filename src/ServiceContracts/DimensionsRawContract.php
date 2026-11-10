<?php

declare(strict_types=1);

namespace ChunkifyAnalytics\ServiceContracts;

use ChunkifyAnalytics\Core\Contracts\BaseResponse;
use ChunkifyAnalytics\Core\Exceptions\APIException;
use ChunkifyAnalytics\Dimensions\DimensionListValuesParams;
use ChunkifyAnalytics\Dimensions\DimensionListValuesParams\Dimension;
use ChunkifyAnalytics\Dimensions\DimensionValues\Value;
use ChunkifyAnalytics\DimensionValuesPage;
use ChunkifyAnalytics\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \ChunkifyAnalytics\RequestOptions
 */
interface DimensionsRawContract
{
    /**
     * @api
     *
     * @param string|Dimension $dimension One custom dimension's values, such as custom.plan.
     * @param array<string,mixed>|DimensionListValuesParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<DimensionValuesPage<Value>>
     *
     * @throws APIException
     */
    public function listValues(
        Dimension|string $dimension,
        array|DimensionListValuesParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}
