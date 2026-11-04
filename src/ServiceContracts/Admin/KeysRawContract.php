<?php

declare(strict_types=1);

namespace ChunkifyAnalytics\ServiceContracts\Admin;

use ChunkifyAnalytics\Admin\Keys\KeyRotateParams;
use ChunkifyAnalytics\Core\Contracts\BaseResponse;
use ChunkifyAnalytics\Core\Exceptions\APIException;
use ChunkifyAnalytics\Project\ProjectKeys;
use ChunkifyAnalytics\Project\RotatedProjectKey;
use ChunkifyAnalytics\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \ChunkifyAnalytics\RequestOptions
 */
interface KeysRawContract
{
    /**
     * @api
     *
     * @param string $projectID project ID returned at creation, or default for the initial project
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<ProjectKeys>
     *
     * @throws APIException
     */
    public function list(
        string $projectID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $keyID key ID from the project key list
     * @param array<string,mixed>|KeyRotateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<RotatedProjectKey>
     *
     * @throws APIException
     */
    public function rotate(
        string $keyID,
        array|KeyRotateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}
