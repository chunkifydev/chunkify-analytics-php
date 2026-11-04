<?php

declare(strict_types=1);

namespace ChunkifyAnalytics\Services\Project;

use ChunkifyAnalytics\Client;
use ChunkifyAnalytics\Core\Contracts\BaseResponse;
use ChunkifyAnalytics\Core\Exceptions\APIException;
use ChunkifyAnalytics\Project\CreatedProjectKey;
use ChunkifyAnalytics\Project\Keys\KeyCreateParams;
use ChunkifyAnalytics\Project\Keys\KeyCreateParams\Permission;
use ChunkifyAnalytics\Project\ProjectKeys;
use ChunkifyAnalytics\Project\RotatedProjectKey;
use ChunkifyAnalytics\RequestOptions;
use ChunkifyAnalytics\ServiceContracts\Project\KeysRawContract;

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
     * Create a named public ingestion key or secret key in the authenticated project. Secret keys default to full project access; set read_only to true for analytics reads and exports only. Requires a full-access project secret key. Read-only keys receive 403 and the installation admin key is not accepted. The key is active immediately and its value is returned once; store it before leaving this response. Each project supports at most 64 active keys, including its initial keys.
     *
     * @param array{
     *   name: string, permission: Permission|value-of<Permission>, readOnly?: bool
     * }|KeyCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<CreatedProjectKey>
     *
     * @throws APIException
     */
    public function create(
        array|KeyCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = KeyCreateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'v1/project/keys',
            body: (object) $parsed,
            options: $options,
            convert: CreatedProjectKey::class,
            security: ['secretKey' => true],
        );
    }

    /**
     * @api
     *
     * List key IDs, names, and types. Key values are not returned. Requires a full-access private key; read-only keys receive 403.
     *
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<ProjectKeys>
     *
     * @throws APIException
     */
    public function list(
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'v1/project/keys',
            options: $requestOptions,
            convert: ProjectKeys::class,
            security: ['secretKey' => true],
        );
    }

    /**
     * @api
     *
     * Replace a key in this project. The old value stops working immediately. Save the returned replacement. Requires a full-access private key; read-only keys receive 403. Only the selected key is rotated. If its replacement is lost, a trusted backend can rotate it again through the installation admin API.
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
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: ['v1/project/keys/%1$s/rotate', $keyID],
            options: $requestOptions,
            convert: RotatedProjectKey::class,
            security: ['secretKey' => true],
        );
    }
}
