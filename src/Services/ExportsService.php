<?php

declare(strict_types=1);

namespace ChunkifyAnalytics\Services;

use ChunkifyAnalytics\Client;
use ChunkifyAnalytics\Core\Exceptions\APIException;
use ChunkifyAnalytics\Core\Util;
use ChunkifyAnalytics\Exports\Export;
use ChunkifyAnalytics\Exports\ExportColumns;
use ChunkifyAnalytics\Exports\ExportCreateParams\Resource;
use ChunkifyAnalytics\Exports\ExportListColumnsParams\GroupBy;
use ChunkifyAnalytics\Exports\ExportListColumnsParams\Kind;
use ChunkifyAnalytics\Exports\ExportQuery;
use ChunkifyAnalytics\RequestOptions;
use ChunkifyAnalytics\ServiceContracts\ExportsContract;

/**
 * @phpstan-import-type ExportQueryShape from \ChunkifyAnalytics\Exports\ExportQuery
 * @phpstan-import-type RequestOpts from \ChunkifyAnalytics\RequestOptions
 */
final class ExportsService implements ExportsContract
{
    /**
     * @api
     */
    public ExportsRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new ExportsRawService($client);
    }

    /**
     * @api
     *
     * Create a scoped 256-bit random download token for all matching rows. Requires a project private key; read-only keys are allowed. The link expires after 30 minutes and is invalidated by issuer-key rotation/revocation, project deletion or collector restart. No CSV is generated or retained at creation. limit/cursor are rejected. Existing query endpoints continue returning JSON. Event CSV files contain documented scalar event fields and flat context.* columns. Custom attributes, nested arrays and historical OTLP payloads are excluded. CSV cells never contain JSON objects or arrays; use GET /v1/events for original payloads.
     *
     * @param resource|value-of<resource> $resource
     * @param list<string> $columns CSV column names in output order. Omit for all columns. Get the available names from GET /v1/exports using the same resource, kind and group_by. Unknown names, duplicates and empty selections are rejected.
     * @param ExportQuery|ExportQueryShape $query
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function create(
        Resource|string $resource,
        ?array $columns = null,
        ExportQuery|array|null $query = null,
        RequestOptions|array|null $requestOptions = null,
    ): Export {
        $params = [];
        $params['resource'] = $resource;
        null !== $columns && $params['columns'] = $columns;
        null !== $query && $params['query'] = $query;

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->create(params: $params, requestOptions: $requestOptions);

        return $response->parse();
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
     * @throws APIException
     */
    public function download(
        string $token,
        RequestOptions|array|null $requestOptions = null
    ): string {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->download($token, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Discover column names before creating an export. Requires a project private key; read-only keys are allowed. kind applies only to timeseries. group_by applies to summary, quality and engagement. Date ranges and filters do not change the columns.
     *
     * @param \ChunkifyAnalytics\Exports\ExportListColumnsParams\Resource|value-of<\ChunkifyAnalytics\Exports\ExportListColumnsParams\Resource> $resource report whose CSV columns to list
     * @param GroupBy|value-of<GroupBy> $groupBy Optional on summary, quality and engagement. Group views by this field on their first retained start. Missing, null and nonstring context forms a null group; the literal device type unknown stays separate. Groups sort by views descending, then value ascending with null first for ties. Pagination is available only with group_by. Location uses the first retained start too. City groups use the stored name; filter by country to avoid combining names shared by different countries. Page groups use the first retained start even if playback continues after navigation. Filter by page_origin when grouping page_path to distinguish identical paths on different sites.
     * @param Kind|value-of<Kind> $kind Metric set for every time bucket. Uses the same calculations and sample counts as the corresponding totals route.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function listColumns(
        \ChunkifyAnalytics\Exports\ExportListColumnsParams\Resource|string $resource,
        GroupBy|string|null $groupBy = null,
        Kind|string $kind = 'summary',
        RequestOptions|array|null $requestOptions = null,
    ): ExportColumns {
        $params = Util::removeNulls(
            ['resource' => $resource, 'groupBy' => $groupBy, 'kind' => $kind]
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->listColumns(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
