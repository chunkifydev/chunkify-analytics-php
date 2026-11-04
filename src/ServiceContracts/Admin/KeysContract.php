<?php

declare(strict_types=1);

namespace ChunkifyAnalytics\ServiceContracts\Admin;

use ChunkifyAnalytics\Core\Exceptions\APIException;
use ChunkifyAnalytics\Project\ProjectKeys;
use ChunkifyAnalytics\Project\RotatedProjectKey;
use ChunkifyAnalytics\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \ChunkifyAnalytics\RequestOptions
 */
interface KeysContract
{
    /**
     * @api
     *
     * @param string $projectID project ID returned at creation, or default for the initial project
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function list(
        string $projectID,
        RequestOptions|array|null $requestOptions = null
    ): ProjectKeys;

    /**
     * @api
     *
     * @param string $keyID key ID from the project key list
     * @param string $projectID project ID returned at creation, or default for the initial project
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function rotate(
        string $keyID,
        string $projectID,
        RequestOptions|array|null $requestOptions = null,
    ): RotatedProjectKey;
}
