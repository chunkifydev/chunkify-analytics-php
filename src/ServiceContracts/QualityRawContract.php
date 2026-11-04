<?php

declare(strict_types=1);

namespace ChunkifyAnalytics\ServiceContracts;

use ChunkifyAnalytics\Core\Contracts\BaseResponse;
use ChunkifyAnalytics\Core\Exceptions\APIException;
use ChunkifyAnalytics\Quality\Quality;
use ChunkifyAnalytics\Quality\QualityBreakdownPage;
use ChunkifyAnalytics\Quality\QualityRetrieveParams;
use ChunkifyAnalytics\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \ChunkifyAnalytics\RequestOptions
 */
interface QualityRawContract
{
    /**
     * @api
     *
     * @param array<string,mixed>|QualityRetrieveParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Quality|QualityBreakdownPage>
     *
     * @throws APIException
     */
    public function retrieve(
        array|QualityRetrieveParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}
