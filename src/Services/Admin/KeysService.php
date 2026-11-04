<?php

declare(strict_types=1);

namespace ChunkifyAnalytics\Services\Admin;

use ChunkifyAnalytics\Client;
use ChunkifyAnalytics\Core\Exceptions\APIException;
use ChunkifyAnalytics\Core\Util;
use ChunkifyAnalytics\Project\ProjectKeys;
use ChunkifyAnalytics\Project\RotatedProjectKey;
use ChunkifyAnalytics\RequestOptions;
use ChunkifyAnalytics\ServiceContracts\Admin\KeysContract;

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
     * List key IDs, names and permissions by project ID using CHUNKIFY_ADMIN_KEY. No project credential is required. Key values are never returned. Intended for a trusted backend that verifies project ownership.
     *
     * @param string $projectID project ID returned at creation, or default for the initial project
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function list(
        string $projectID,
        RequestOptions|array|null $requestOptions = null
    ): ProjectKeys {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->list($projectID, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Replace one existing public or secret key using CHUNKIFY_ADMIN_KEY, even when the project secret was lost. The old value stops working immediately. Key ID, type and read-only access are preserved; other keys are unchanged. Save the returned replacement. Intended for a trusted backend that verifies project ownership.
     *
     * @param string $keyID key ID from the project key list
     * @param string $projectID project ID returned at creation, or default for the initial project
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function rotate(
        string $keyID,
        string $projectID,
        RequestOptions|array|null $requestOptions = null,
    ): RotatedProjectKey {
        $params = Util::removeNulls(['projectID' => $projectID]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->rotate($keyID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
