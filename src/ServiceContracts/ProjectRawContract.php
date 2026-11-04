<?php

declare(strict_types=1);

namespace ChunkifyAnalytics\ServiceContracts;

use ChunkifyAnalytics\Core\Contracts\BaseResponse;
use ChunkifyAnalytics\Core\Exceptions\APIException;
use ChunkifyAnalytics\Project\DeletedProject;
use ChunkifyAnalytics\Project\Project;
use ChunkifyAnalytics\Project\ProjectUpdateParams;
use ChunkifyAnalytics\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \ChunkifyAnalytics\RequestOptions
 */
interface ProjectRawContract
{
    /**
     * @api
     *
     * @param array<string,mixed>|ProjectUpdateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Project>
     *
     * @throws APIException
     */
    public function update(
        array|ProjectUpdateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<DeletedProject>
     *
     * @throws APIException
     */
    public function delete(
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse;
}
