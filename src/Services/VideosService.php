<?php

declare(strict_types=1);

namespace ChunkifyAnalytics\Services;

use ChunkifyAnalytics\Client;
use ChunkifyAnalytics\Core\Exceptions\APIException;
use ChunkifyAnalytics\Core\Util;
use ChunkifyAnalytics\RequestOptions;
use ChunkifyAnalytics\ServiceContracts\VideosContract;
use ChunkifyAnalytics\Videos\VideoListParams\Continent;
use ChunkifyAnalytics\Videos\VideoListParams\DeviceType;
use ChunkifyAnalytics\Videos\VideoListParams\Order;
use ChunkifyAnalytics\Videos\VideoListParams\SortBy;
use ChunkifyAnalytics\Videos\VideoMetrics;
use ChunkifyAnalytics\VideosPage;

/**
 * Private retained-event and view-cohort queries.
 *
 * @phpstan-import-type RequestOpts from \ChunkifyAnalytics\RequestOptions
 */
final class VideosService implements VideosContract
{
    /**
     * @api
     */
    public VideosRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new VideosRawService($client);
    }

    /**
     * @api
     *
     * List per-video totals. Sort the entire filtered cohort by video_id, views, unique_viewers, total_playing_time_ms or playback_score before pagination. Defaults to video_id ascending. Missing scores come last; metric ties use video_id ascending in both directions. Unique viewer counts cannot be added across videos. Keep sort_by, order and filters unchanged with a cursor.
     *
     * @param string $browserName Exact browser name, such as Chrome. Missing values do not match.
     * @param string $city Exact, case-sensitive city name from the local lookup, with 1 to 256 Unicode characters. Use country alongside city to distinguish places with the same name. Missing locations do not match.
     * @param Continent|value-of<Continent> $continent Exact continent code from the local lookup. Missing locations do not match.
     * @param string $country Exact uppercase ISO 3166-1 alpha-2 country code, such as GB. Missing locations do not match.
     * @param string $cursor Use next_cursor from the previous page. Keep the same filters, sort_by and order. Video cursors from earlier versions are invalid; start a new pagination sequence after upgrading.
     * @param DeviceType|value-of<DeviceType> $deviceType Exact device class. unknown matches an explicit unknown value.
     * @param \DateTimeInterface $from Inclusive RFC3339 occurrence-time lower bound, with timezone. Summary/video queries apply it to the selected view_started event. Must be before to.
     * @param int $limit Maximum rows on this page. Events and videos always support pagination; summary, quality and engagement support it only with group_by.
     * @param Order|value-of<Order> $order Sort direction. Events and videos default to asc; views default to desc. Events sort by ingestion sequence. Videos and views sort by sort_by with missing values last. View ties use view_id in the requested direction; video metric ties use video_id ascending.
     * @param string $osName Exact operating-system name, such as macOS. Missing values do not match.
     * @param string $pageOrigin Exact, case-sensitive page origin captured by the player, such as https://example.com. Metrics use the first retained view start; raw events use each event context. Missing values do not match.
     * @param string $pagePath Exact, case-sensitive page path captured by the player, such as /watch/video. Filter by page_origin as well to distinguish identical paths on different sites. Metrics use the first retained view start; raw events use each event context. Missing values do not match.
     * @param SortBy|value-of<SortBy> $sortBy Rank all matching videos before pagination. Missing scores come last in both directions. Metric ties use video_id ascending. Keep sort_by, order and filters unchanged with a cursor.
     * @param \DateTimeInterface $to Exclusive RFC3339 occurrence-time upper bound, with timezone. Summary/video queries apply it to the selected view_started event.
     * @param string $videoID Exact video ID. Combined with all other filters using AND.
     * @param string $viewID Filter one playback attempt by view ID. Metrics use its first retained start.
     * @param string $viewerID Exact supplied viewer ID. Missing/null viewer IDs do not match.
     * @param RequestOpts|null $requestOptions
     *
     * @return VideosPage<VideoMetrics>
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
        int $limit = 100,
        Order|string $order = 'asc',
        ?string $osName = null,
        ?string $pageOrigin = null,
        ?string $pagePath = null,
        SortBy|string $sortBy = 'video_id',
        ?\DateTimeInterface $to = null,
        ?string $videoID = null,
        ?string $viewID = null,
        ?string $viewerID = null,
        RequestOptions|array|null $requestOptions = null,
    ): VideosPage {
        $params = Util::removeNulls(
            [
                'browserName' => $browserName,
                'city' => $city,
                'continent' => $continent,
                'country' => $country,
                'cursor' => $cursor,
                'deviceType' => $deviceType,
                'from' => $from,
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
