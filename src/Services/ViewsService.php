<?php

declare(strict_types=1);

namespace ChunkifyAnalytics\Services;

use ChunkifyAnalytics\Client;
use ChunkifyAnalytics\Core\Exceptions\APIException;
use ChunkifyAnalytics\Core\Util;
use ChunkifyAnalytics\RequestOptions;
use ChunkifyAnalytics\ServiceContracts\ViewsContract;
use ChunkifyAnalytics\Views\View;
use ChunkifyAnalytics\Views\ViewDetail;
use ChunkifyAnalytics\Views\ViewListParams\Continent;
use ChunkifyAnalytics\Views\ViewListParams\DeviceType;
use ChunkifyAnalytics\Views\ViewListParams\Order;
use ChunkifyAnalytics\Views\ViewListParams\SortBy;
use ChunkifyAnalytics\ViewsPage;

/**
 * Private retained-event and view-cohort queries.
 *
 * @phpstan-import-type RequestOpts from \ChunkifyAnalytics\RequestOptions
 */
final class ViewsService implements ViewsContract
{
    /**
     * @api
     */
    public ViewsRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new ViewsRawService($client);
    }

    /**
     * @api
     *
     * Returns start context and selected measurements, plus a paginated history of all retained events for that view ID, in ingestion order. SDK sequence and occurrence times remain in each event. Follow next_cursor with the same view ID; the summary and event pages share the initial ingestion watermark. Orphaned events without a retained start remain available through /v1/events?view_id=... .
     *
     * @param string $viewID playback attempt to inspect
     * @param string $cursor Use next_cursor from the previous page. Keep the same filters, sort_by and order. Video cursors from earlier versions are invalid; start a new pagination sequence after upgrading.
     * @param int $limit Maximum rows on this page. Events and videos always support pagination; summary, quality and engagement support it only with group_by.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $viewID,
        ?string $cursor = null,
        int $limit = 100,
        RequestOptions|array|null $requestOptions = null,
    ): ViewDetail {
        $params = Util::removeNulls(['cursor' => $cursor, 'limit' => $limit]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieve($viewID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * One row per first retained start, using the same final/latest measurement selection as metrics. Filter by identity, context, dates or has_fatal_error. Order by started_at descending by default (newest first), or ascending with order=asc. Equal start times use view_id in the same direction. Cursors bind filters, order, fatal-error selection, project and ingestion watermark. Missing end or error events are not proof of an ongoing or successful playback. Sort the entire matching cohort by sort_by before pagination, with missing values last.
     *
     * @param string $browserName Exact browser name, such as Chrome. Missing values do not match.
     * @param string $city Exact, case-sensitive city name from the local lookup, with 1 to 256 Unicode characters. Use country alongside city to distinguish places with the same name. Missing locations do not match.
     * @param Continent|value-of<Continent> $continent Exact continent code from the local lookup. Missing locations do not match.
     * @param string $country Exact uppercase ISO 3166-1 alpha-2 country code, such as GB. Missing locations do not match.
     * @param string $cursor Use next_cursor from the previous page. Keep the same filters, sort_by and order. Video cursors from earlier versions are invalid; start a new pagination sequence after upgrading.
     * @param DeviceType|value-of<DeviceType> $deviceType Exact device class. unknown matches an explicit unknown value.
     * @param \DateTimeInterface $from Inclusive RFC3339 occurrence-time lower bound, with timezone. Summary/video queries apply it to the selected view_started event. Must be before to.
     * @param bool $hasFatalError Select attempts with or without an observed fatal error. Absence of an observed error does not prove successful playback.
     * @param int $limit Maximum rows on this page. Events and videos always support pagination; summary, quality and engagement support it only with group_by.
     * @param Order|value-of<Order> $order Sort by started_at and then view_id in this direction. Defaults to newest first. Keep the same order with each cursor.
     * @param string $osName Exact operating-system name, such as macOS. Missing values do not match.
     * @param string $pageOrigin Exact, case-sensitive page origin captured by the player, such as https://example.com. Metrics use the first retained view start; raw events use each event context. Missing values do not match.
     * @param string $pagePath Exact, case-sensitive page path captured by the player, such as /watch/video. Filter by page_origin as well to distinguish identical paths on different sites. Metrics use the first retained view start; raw events use each event context. Missing values do not match.
     * @param SortBy|value-of<SortBy> $sortBy Sort all matching sessions before pagination. Missing values come last in both directions. Ties use view_id in the requested direction. Keep sort_by, order and filters unchanged with a cursor.
     * @param \DateTimeInterface $to Exclusive RFC3339 occurrence-time upper bound, with timezone. Summary/video queries apply it to the selected view_started event.
     * @param string $videoID Exact video ID. Combined with all other filters using AND.
     * @param string $viewID Filter one playback attempt by view ID. Metrics use its first retained start.
     * @param string $viewerID Exact supplied viewer ID. Missing/null viewer IDs do not match.
     * @param RequestOpts|null $requestOptions
     *
     * @return ViewsPage<View>
     *
     * @throws APIException
     */
    public function list(
        ?string $browserName = null,
        ?string $city = null,
        Continent|string|null $continent = null,
        ?string $country = null,
        ?string $cursor = null,
        DeviceType|string|null $deviceType = null,
        ?\DateTimeInterface $from = null,
        ?bool $hasFatalError = null,
        int $limit = 100,
        Order|string $order = 'desc',
        ?string $osName = null,
        ?string $pageOrigin = null,
        ?string $pagePath = null,
        SortBy|string $sortBy = 'started_at',
        ?\DateTimeInterface $to = null,
        ?string $videoID = null,
        ?string $viewID = null,
        ?string $viewerID = null,
        RequestOptions|array|null $requestOptions = null,
    ): ViewsPage {
        $params = Util::removeNulls(
            [
                'browserName' => $browserName,
                'city' => $city,
                'continent' => $continent,
                'country' => $country,
                'cursor' => $cursor,
                'deviceType' => $deviceType,
                'from' => $from,
                'hasFatalError' => $hasFatalError,
                'limit' => $limit,
                'order' => $order,
                'osName' => $osName,
                'pageOrigin' => $pageOrigin,
                'pagePath' => $pagePath,
                'sortBy' => $sortBy,
                'to' => $to,
                'videoID' => $videoID,
                'viewID' => $viewID,
                'viewerID' => $viewerID,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->list(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
