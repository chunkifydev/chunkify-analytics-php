<?php

declare(strict_types=1);

namespace ChunkifyAnalytics\Services;

use ChunkifyAnalytics\Client;
use ChunkifyAnalytics\Core\Contracts\BaseResponse;
use ChunkifyAnalytics\Core\Exceptions\APIException;
use ChunkifyAnalytics\Core\Util;
use ChunkifyAnalytics\Exports\Export;
use ChunkifyAnalytics\Exports\ExportColumns;
use ChunkifyAnalytics\Exports\ExportCreateParams;
use ChunkifyAnalytics\Exports\ExportCreateParams\Resource;
use ChunkifyAnalytics\Exports\ExportListColumnsParams;
use ChunkifyAnalytics\Exports\ExportListColumnsParams\GroupBy;
use ChunkifyAnalytics\Exports\ExportListColumnsParams\Kind;
use ChunkifyAnalytics\Exports\ExportQuery;
use ChunkifyAnalytics\RequestOptions;
use ChunkifyAnalytics\ServiceContracts\ExportsRawContract;

/**
 * @phpstan-import-type ExportQueryShape from \ChunkifyAnalytics\Exports\ExportQuery
 * @phpstan-import-type RequestOpts from \ChunkifyAnalytics\RequestOptions
 */
final class ExportsRawService implements ExportsRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Create a scoped 256-bit random download token for all matching rows. Requires a project private key; read-only keys are allowed. The link expires after 30 minutes and is invalidated by issuer-key rotation/revocation, project deletion or collector restart. No CSV is generated or retained at creation. limit/cursor are rejected. Existing query endpoints continue returning JSON. Event CSV files contain documented scalar event fields and flat context.* columns. Custom attributes, nested arrays and historical OTLP payloads are excluded. CSV cells never contain JSON objects or arrays; use GET /v1/events for original payloads.
     *
     * @param array{
     *   resource: value-of<resource>,
     *   columns?: list<string>,
     *   query?: ExportQuery|ExportQueryShape,
     * }|ExportCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Export>
     *
     * @throws APIException
     */
    public function create(
        array|ExportCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = ExportCreateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'v1/exports',
            body: (object) $parsed,
            options: $options,
            convert: Export::class,
            security: ['secretKey' => true],
        );
    }

    /**
     * @api
     *
     * The token authorizes only its saved project and query. Requires no Authorization header and accepts no query parameters. Generate CSV on demand from one read snapshot on a dedicated connection; stream with bounded application buffers and backpressure. Dataset is selected when the link is opened. Rows are not capped by query pagination. Nested metric columns use slash-separated paths. Events have documented scalar columns and flat context.* columns. Custom attributes, nested arrays and historical OTLP payloads are excluded. CSV cells never contain JSON objects or arrays. Nulls are empty cells; spreadsheet-formula strings are prefixed with an apostrophe. Interrupted or failed downloads terminate the stream; retry the full download. No files are retained. Defaults: 2 download starts/minute per project with burst capacity 2, one active CSV generation per project and four server-wide. Limits are shared across keys and links. Excess requests receive 429 with Retry-After instead of queueing. Override limits in config.toml [rate_limits]. Link expiry is checked before starting, not during an active download. S3 retention/deletion can remove source objects during a download.
     *
     * The download URL contains the credential needed for this request. Treat it
     * as a secret until it expires. You can call this method without configuring
     * an API key on the client.
     *
     * @param string $token Unguessable scoped download credential. No project key is needed.
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<string>
     *
     * @throws APIException
     */
    public function download(
        string $token,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['v1/exports/%1$s', $token],
            headers: ['Accept' => 'text/csv'],
            options: $requestOptions,
            convert: 'string',
            security: [],
        );
    }

    /**
     * @api
     *
     * Discover column names before creating an export. Requires a project private key; read-only keys are allowed. kind applies only to timeseries. group_by applies to summary, quality and engagement. Date ranges and filters do not change the columns.
     *
     * @param array{
     *   resource: value-of<ExportListColumnsParams\Resource>,
     *   groupBy?: value-of<GroupBy>,
     *   kind?: Kind|value-of<Kind>,
     * }|ExportListColumnsParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<ExportColumns>
     *
     * @throws APIException
     */
    public function listColumns(
        array|ExportListColumnsParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = ExportListColumnsParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'v1/exports',
            query: Util::array_transform_keys($parsed, ['groupBy' => 'group_by']),
            options: $options,
            convert: ExportColumns::class,
            security: ['secretKey' => true],
        );
    }
}
