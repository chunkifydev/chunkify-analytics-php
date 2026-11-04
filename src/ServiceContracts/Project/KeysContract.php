<?php

declare(strict_types=1);

namespace ChunkifyAnalytics\ServiceContracts\Project;

use ChunkifyAnalytics\Core\Exceptions\APIException;
use ChunkifyAnalytics\Project\CreatedProjectKey;
use ChunkifyAnalytics\Project\Keys\KeyCreateParams\Permission;
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
     * @param string $name Key display name, up to 128 UTF-8 bytes. Whitespace-only names are rejected.
     * @param Permission|value-of<Permission> $permission
     * @param bool $readOnly Only secret keys can be read-only. False grants full project management access to secret keys; public keys only ingest events.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function create(
        string $name,
        Permission|string $permission,
        bool $readOnly = false,
        RequestOptions|array|null $requestOptions = null,
    ): CreatedProjectKey;

    /**
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function list(
        RequestOptions|array|null $requestOptions = null
    ): ProjectKeys;

    /**
     * @api
     *
     * @param string $keyID key ID from the project key list
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function rotate(
        string $keyID,
        RequestOptions|array|null $requestOptions = null
    ): RotatedProjectKey;
}
