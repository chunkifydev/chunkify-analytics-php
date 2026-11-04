<?php

declare(strict_types=1);

namespace ChunkifyAnalytics\ServiceContracts\Project;

use ChunkifyAnalytics\Core\Contracts\BaseResponse;
use ChunkifyAnalytics\Core\Exceptions\APIException;
use ChunkifyAnalytics\Project\CreatedProjectKey;
use ChunkifyAnalytics\Project\Keys\KeyCreateParams;
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
     * @param array<string,mixed>|KeyCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<CreatedProjectKey>
     *
     * @throws APIException
     */
    public function create(
        array|KeyCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<ProjectKeys>
     *
     * @throws APIException
     */
    public function list(
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $keyID key ID from the project key list
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<RotatedProjectKey>
     *
     * @throws APIException
     */
    public function rotate(
        string $keyID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse;
}
