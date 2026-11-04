<?php

declare(strict_types=1);

namespace ChunkifyAnalytics\Services;

use ChunkifyAnalytics\Admin\AdminCreateProjectParams;
use ChunkifyAnalytics\Admin\CreatedProject;
use ChunkifyAnalytics\Client;
use ChunkifyAnalytics\Core\Contracts\BaseResponse;
use ChunkifyAnalytics\Core\Exceptions\APIException;
use ChunkifyAnalytics\RequestOptions;
use ChunkifyAnalytics\ServiceContracts\AdminRawContract;

/**
 * Project origins and keys.
 *
 * @phpstan-import-type RequestOpts from \ChunkifyAnalytics\RequestOptions
 */
final class AdminRawService implements AdminRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Generate a project ID and initial keys, optionally setting retention. Requires the installation admin key. The project and its retention are active before success is returned.
     *
     * @param array{
     *   name: string, allowedOrigins?: list<string>, retentionSeconds?: int|null
     * }|AdminCreateProjectParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<CreatedProject>
     *
     * @throws APIException
     */
    public function createProject(
        array|AdminCreateProjectParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = AdminCreateProjectParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'v1/projects',
            body: (object) $parsed,
            options: $options,
            convert: CreatedProject::class,
            security: ['adminKey' => true],
        );
    }
}
