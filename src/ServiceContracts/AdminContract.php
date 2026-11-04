<?php

declare(strict_types=1);

namespace ChunkifyAnalytics\ServiceContracts;

use ChunkifyAnalytics\Admin\CreatedProject;
use ChunkifyAnalytics\Core\Exceptions\APIException;
use ChunkifyAnalytics\Core\Omit;
use ChunkifyAnalytics\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \ChunkifyAnalytics\RequestOptions
 */
interface AdminContract
{
    /**
     * @api
     *
     * @param string $name project display name
     * @param list<string> $allowedOrigins Additional project origins. Shared TOML origins are always included.
     * @param int|Omit|null $retentionSeconds Retention by server receipt time, in seconds. 0 disables expiration; null inherits the installation default. Omission also inherits the default.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function createProject(
        string $name,
        ?array $allowedOrigins = null,
        int|Omit|null $retentionSeconds = Omit::Value,
        RequestOptions|array|null $requestOptions = null,
    ): CreatedProject;
}
