<?php

declare(strict_types=1);

namespace ChunkifyAnalytics\ServiceContracts;

use ChunkifyAnalytics\Core\Exceptions\APIException;
use ChunkifyAnalytics\Core\Omit;
use ChunkifyAnalytics\Project\DeletedProject;
use ChunkifyAnalytics\Project\Project;
use ChunkifyAnalytics\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \ChunkifyAnalytics\RequestOptions
 */
interface ProjectContract
{
    /**
     * @api
     *
     * @param list<string> $allowedOrigins Additional project origins. Shared TOML origins are always included.
     * @param int|Omit|null $retentionSeconds Retention by server receipt time, in seconds. 0 disables expiration; null inherits the installation default. Omission leaves the current setting unchanged. Applies to existing and new events; removed data cannot be recovered.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function update(
        ?array $allowedOrigins = null,
        ?string $name = null,
        int|Omit|null $retentionSeconds = Omit::Value,
        RequestOptions|array|null $requestOptions = null,
    ): Project;

    /**
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function delete(
        RequestOptions|array|null $requestOptions = null
    ): DeletedProject;
}
