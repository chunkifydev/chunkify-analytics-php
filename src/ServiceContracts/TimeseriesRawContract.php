<?php

declare(strict_types=1);

namespace ChunkifyAnalytics\ServiceContracts;

use ChunkifyAnalytics\Core\Contracts\BaseResponse;
use ChunkifyAnalytics\Core\Exceptions\APIException;
use ChunkifyAnalytics\RequestOptions;
use ChunkifyAnalytics\Timeseries\EngagementTimeseries;
use ChunkifyAnalytics\Timeseries\QualityTimeseries;
use ChunkifyAnalytics\Timeseries\Timeseries;
use ChunkifyAnalytics\Timeseries\TimeseryRetrieveParams;

/**
 * @phpstan-import-type RequestOpts from \ChunkifyAnalytics\RequestOptions
 */
interface TimeseriesRawContract
{
    /**
     * @api
     *
     * @param array<string,mixed>|TimeseryRetrieveParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Timeseries|QualityTimeseries|EngagementTimeseries>
     *
     * @throws APIException
     */
    public function retrieve(
        array|TimeseryRetrieveParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}
