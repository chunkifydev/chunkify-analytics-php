<?php

declare(strict_types=1);

namespace ChunkifyAnalytics\ServiceContracts;

use ChunkifyAnalytics\Core\Contracts\BaseResponse;
use ChunkifyAnalytics\Core\Exceptions\APIException;
use ChunkifyAnalytics\PlaybackRates\PlaybackRateReport;
use ChunkifyAnalytics\PlaybackRates\PlaybackRateRetrieveParams;
use ChunkifyAnalytics\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \ChunkifyAnalytics\RequestOptions
 */
interface PlaybackRatesRawContract
{
    /**
     * @api
     *
     * @param array<string,mixed>|PlaybackRateRetrieveParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<PlaybackRateReport>
     *
     * @throws APIException
     */
    public function retrieve(
        array|PlaybackRateRetrieveParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}
