<?php

declare(strict_types=1);

namespace ChunkifyAnalytics\Services\Admin;

use ChunkifyAnalytics\Admin\Keys\KeyRotateParams;
use ChunkifyAnalytics\Client;
use ChunkifyAnalytics\Core\Contracts\BaseResponse;
use ChunkifyAnalytics\Core\Exceptions\APIException;
use ChunkifyAnalytics\Project\ProjectKeys;
use ChunkifyAnalytics\Project\RotatedProjectKey;
use ChunkifyAnalytics\RequestOptions;
use ChunkifyAnalytics\ServiceContracts\Admin\KeysRawContract;

/**
 * Project origins and keys.
 *
 * @phpstan-import-type RequestOpts from \ChunkifyAnalytics\RequestOptions
 */
final class KeysRawService implements KeysRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * List key IDs, names and permissions by project ID using CHUNKIFY_ADMIN_KEY. No project credential is required. Key values are never returned. Intended for a trusted backend that verifies project ownership.
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
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['v1/projects/%1$s/keys', $projectID],
            options: $requestOptions,
            convert: ProjectKeys::class,
            security: ['adminKey' => true],
        );
    }

    /**
     * @api
     *
     * Replace one existing public or secret key using CHUNKIFY_ADMIN_KEY, even when the project secret was lost. The old value stops working immediately. Key ID, type and read-only access are preserved; other keys are unchanged. Save the returned replacement. Intended for a trusted backend that verifies project ownership.
     *
     * @param string $keyID key ID from the project key list
     * @param array{projectID: string}|KeyRotateParams $params
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
    ): BaseResponse {
        [$parsed, $options] = KeyRotateParams::parseRequest(
            $params,
            $requestOptions,
        );
        $projectID = $parsed['projectID'];
        unset($parsed['projectID']);

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: ['v1/projects/%1$s/keys/%2$s/rotate', $projectID, $keyID],
            options: $options,
            convert: RotatedProjectKey::class,
            security: ['adminKey' => true],
        );
    }
}
