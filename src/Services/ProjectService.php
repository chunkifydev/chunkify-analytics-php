<?php

declare(strict_types=1);

namespace ChunkifyAnalytics\Services;

use ChunkifyAnalytics\Client;
use ChunkifyAnalytics\Core\Exceptions\APIException;
use ChunkifyAnalytics\Core\Omit;
use ChunkifyAnalytics\Project\DeletedProject;
use ChunkifyAnalytics\Project\Project;
use ChunkifyAnalytics\RequestOptions;
use ChunkifyAnalytics\ServiceContracts\ProjectContract;
use ChunkifyAnalytics\Services\Project\KeysService;

/**
 * Project origins and keys.
 *
 * @phpstan-import-type RequestOpts from \ChunkifyAnalytics\RequestOptions
 */
final class ProjectService implements ProjectContract
{
    /**
     * @api
     */
    public ProjectRawService $raw;

    /**
     * @api
     */
    public KeysService $keys;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new ProjectRawService($client);
        $this->keys = new KeysService($client);
    }

    /**
     * @api
     *
     * Update the name, additional origins or retention of your project. Omitted fields stay unchanged. Set retention_seconds to null to inherit the installation default, or 0 to disable expiration. Changes apply to existing and new events without a restart. Requires a full-access private key; read-only keys receive 403.
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
    ): Project {
        $params = [];
        null !== $allowedOrigins && $params['allowedOrigins'] = $allowedOrigins;
        null !== $name && $params['name'] = $name;
        Omit::Value !== $retentionSeconds && $params['retentionSeconds'] = $retentionSeconds;

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->update(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Revoke all project keys. Stored events remain until their retention expires. Requires a full-access private key; read-only keys receive 403.
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function delete(
        RequestOptions|array|null $requestOptions = null
    ): DeletedProject {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->delete(requestOptions: $requestOptions);

        return $response->parse();
    }
}
