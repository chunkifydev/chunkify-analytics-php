<?php

declare(strict_types=1);

namespace ChunkifyAnalytics\ServiceContracts;

use ChunkifyAnalytics\Core\Contracts\BaseResponse;
use ChunkifyAnalytics\Core\Exceptions\APIException;
use ChunkifyAnalytics\Engagement\Engagement;
use ChunkifyAnalytics\Engagement\EngagementBreakdownPage;
use ChunkifyAnalytics\Engagement\EngagementRetrieveParams;
use ChunkifyAnalytics\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \ChunkifyAnalytics\RequestOptions
 */
interface EngagementRawContract
{
    /**
     * @api
     *
     * @param array<string,mixed>|EngagementRetrieveParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Engagement|EngagementBreakdownPage>
     *
     * @throws APIException
     */
    public function retrieve(
        array|EngagementRetrieveParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}
