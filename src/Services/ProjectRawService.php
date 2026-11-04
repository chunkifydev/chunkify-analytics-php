<?php

declare(strict_types=1);

namespace ChunkifyAnalytics\Services;

use ChunkifyAnalytics\Client;
use ChunkifyAnalytics\Core\Contracts\BaseResponse;
use ChunkifyAnalytics\Core\Exceptions\APIException;
use ChunkifyAnalytics\Project\DeletedProject;
use ChunkifyAnalytics\Project\Project;
use ChunkifyAnalytics\Project\ProjectUpdateParams;
use ChunkifyAnalytics\RequestOptions;
use ChunkifyAnalytics\ServiceContracts\ProjectRawContract;

/**
 * Project origins and keys.
 *
 * @phpstan-import-type RequestOpts from \ChunkifyAnalytics\RequestOptions
 */
final class ProjectRawService implements ProjectRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Update the name, additional origins or retention of your project. Omitted fields stay unchanged. Set retention_seconds to null to inherit the installation default, or 0 to disable expiration. Changes apply to existing and new events without a restart. Requires a full-access private key; read-only keys receive 403.
     *
     * @param array{
     *   allowedOrigins?: list<string>, name?: string, retentionSeconds?: int|null
     * }|ProjectUpdateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Project>
     *
     * @throws APIException
     */
    public function update(
        array|ProjectUpdateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = ProjectUpdateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'patch',
            path: 'v1/project',
            body: (object) $parsed,
            options: $options,
            convert: Project::class,
            security: ['secretKey' => true],
        );
    }

    /**
     * @api
     *
     * Revoke all project keys. Stored events remain until their retention expires. Requires a full-access private key; read-only keys receive 403.
     *
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<DeletedProject>
     *
     * @throws APIException
     */
    public function delete(
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'delete',
            path: 'v1/project',
            options: $requestOptions,
            convert: DeletedProject::class,
            security: ['secretKey' => true],
        );
    }
}
