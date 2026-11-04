<?php

declare(strict_types=1);

namespace ChunkifyAnalytics\ServiceContracts;

use ChunkifyAnalytics\Admin\AdminCreateProjectParams;
use ChunkifyAnalytics\Admin\CreatedProject;
use ChunkifyAnalytics\Core\Contracts\BaseResponse;
use ChunkifyAnalytics\Core\Exceptions\APIException;
use ChunkifyAnalytics\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \ChunkifyAnalytics\RequestOptions
 */
interface AdminRawContract
{
    /**
     * @api
     *
     * @param array<string,mixed>|AdminCreateProjectParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<CreatedProject>
     *
     * @throws APIException
     */
    public function createProject(
        array|AdminCreateProjectParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}
