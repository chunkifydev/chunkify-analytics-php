<?php

declare(strict_types=1);

namespace ChunkifyAnalytics\ServiceContracts;

use ChunkifyAnalytics\Core\Contracts\BaseResponse;
use ChunkifyAnalytics\Core\Exceptions\APIException;
use ChunkifyAnalytics\Errors\ErrorGroup;
use ChunkifyAnalytics\Errors\ErrorListParams;
use ChunkifyAnalytics\ErrorsPage;
use ChunkifyAnalytics\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \ChunkifyAnalytics\RequestOptions
 */
interface ErrorsRawContract
{
    /**
     * @api
     *
     * @param array<string,mixed>|ErrorListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<ErrorsPage<ErrorGroup>>
     *
     * @throws APIException
     */
    public function list(
        array|ErrorListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}
