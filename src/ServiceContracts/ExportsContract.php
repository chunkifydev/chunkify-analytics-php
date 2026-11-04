<?php

declare(strict_types=1);

namespace ChunkifyAnalytics\ServiceContracts;

use ChunkifyAnalytics\Core\Exceptions\APIException;
use ChunkifyAnalytics\Exports\Export;
use ChunkifyAnalytics\Exports\ExportColumns;
use ChunkifyAnalytics\Exports\ExportCreateParams\Resource;
use ChunkifyAnalytics\Exports\ExportListColumnsParams\GroupBy;
use ChunkifyAnalytics\Exports\ExportListColumnsParams\Kind;
use ChunkifyAnalytics\Exports\ExportQuery;
use ChunkifyAnalytics\RequestOptions;

/**
 * @phpstan-import-type ExportQueryShape from \ChunkifyAnalytics\Exports\ExportQuery
 * @phpstan-import-type RequestOpts from \ChunkifyAnalytics\RequestOptions
 */
interface ExportsContract
{
    /**
     * @api
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
    ): Export;

    /**
     * @api
     *
     * @param string $token Unguessable scoped download credential. No project key is needed.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function download(
        string $token,
        RequestOptions|array|null $requestOptions = null
    ): string;

    /**
     * @api
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
    ): ExportColumns;
}
