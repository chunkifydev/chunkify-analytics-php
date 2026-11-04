<?php

declare(strict_types=1);

namespace ChunkifyAnalytics\ServiceContracts;

use ChunkifyAnalytics\Core\Contracts\BaseResponse;
use ChunkifyAnalytics\Core\Exceptions\APIException;
use ChunkifyAnalytics\RequestOptions;
use ChunkifyAnalytics\Videos\VideoListParams;
use ChunkifyAnalytics\Videos\VideoMetrics;
use ChunkifyAnalytics\VideosPage;

/**
 * @phpstan-import-type RequestOpts from \ChunkifyAnalytics\RequestOptions
 */
interface VideosRawContract
{
    /**
     * @api
     *
     * @param array<string,mixed>|VideoListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<VideosPage<VideoMetrics>>
     *
     * @throws APIException
     */
    public function list(
        array|VideoListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}
