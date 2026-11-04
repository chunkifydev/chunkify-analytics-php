<?php

declare(strict_types=1);

namespace ChunkifyAnalytics\Services\Project;

use ChunkifyAnalytics\Client;
use ChunkifyAnalytics\Core\Exceptions\APIException;
use ChunkifyAnalytics\Project\CreatedProjectKey;
use ChunkifyAnalytics\Project\Keys\KeyCreateParams\Permission;
use ChunkifyAnalytics\Project\ProjectKeys;
use ChunkifyAnalytics\Project\RotatedProjectKey;
use ChunkifyAnalytics\RequestOptions;
use ChunkifyAnalytics\ServiceContracts\Project\KeysContract;

/**
 * Project origins and keys.
 *
 * @phpstan-import-type RequestOpts from \ChunkifyAnalytics\RequestOptions
 */
final class KeysService implements KeysContract
{
    /**
     * @api
     */
    public KeysRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new KeysRawService($client);
    }

    /**
     * @api
     *
     * Create a named public ingestion key or secret key in the authenticated project. Secret keys default to full project access; set read_only to true for analytics reads and exports only. Requires a full-access project secret key. Read-only keys receive 403 and the installation admin key is not accepted. The key is active immediately and its value is returned once; store it before leaving this response. Each project supports at most 64 active keys, including its initial keys.
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
    ): CreatedProjectKey {
        $params = [];
        $params['name'] = $name;
        $params['permission'] = $permission;
        $params['readOnly'] = $readOnly;

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->create(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * List key IDs, names, and types. Key values are not returned. Requires a full-access private key; read-only keys receive 403.
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function list(
        RequestOptions|array|null $requestOptions = null
    ): ProjectKeys {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->list(requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Replace a key in this project. The old value stops working immediately. Save the returned replacement. Requires a full-access private key; read-only keys receive 403. Only the selected key is rotated. If its replacement is lost, a trusted backend can rotate it again through the installation admin API.
     *
     * @param string $keyID key ID from the project key list
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function rotate(
        string $keyID,
        RequestOptions|array|null $requestOptions = null
    ): RotatedProjectKey {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->rotate($keyID, requestOptions: $requestOptions);

        return $response->parse();
    }
}
