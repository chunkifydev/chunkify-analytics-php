<?php

declare(strict_types=1);

namespace ChunkifyAnalytics\Services;

use ChunkifyAnalytics\Admin\CreatedProject;
use ChunkifyAnalytics\Client;
use ChunkifyAnalytics\Core\Exceptions\APIException;
use ChunkifyAnalytics\Core\Omit;
use ChunkifyAnalytics\RequestOptions;
use ChunkifyAnalytics\ServiceContracts\AdminContract;
use ChunkifyAnalytics\Services\Admin\KeysService;

/**
 * Project origins and keys.
 *
 * @phpstan-import-type RequestOpts from \ChunkifyAnalytics\RequestOptions
 */
final class AdminService implements AdminContract
{
    /**
     * @api
     */
    public AdminRawService $raw;

    /**
     * @api
     */
    public KeysService $keys;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new AdminRawService($client);
        $this->keys = new KeysService($client);
    }

    /**
     * @api
     *
     * Generate a project ID and initial keys, optionally setting retention. Requires the installation admin key. The project and its retention are active before success is returned.
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
    ): CreatedProject {
        $params = [];
        $params['name'] = $name;
        null !== $allowedOrigins && $params['allowedOrigins'] = $allowedOrigins;
        Omit::Value !== $retentionSeconds && $params['retentionSeconds'] = $retentionSeconds;

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->createProject(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
