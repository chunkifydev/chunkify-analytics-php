<?php

declare(strict_types=1);

namespace ChunkifyAnalytics\ServiceContracts;

use ChunkifyAnalytics\Core\Exceptions\APIException;
use ChunkifyAnalytics\Events\EventIngestParams\ContentEncoding;
use ChunkifyAnalytics\Events\EventListParams\Continent;
use ChunkifyAnalytics\Events\EventListParams\DeviceType;
use ChunkifyAnalytics\Events\EventListParams\EventName;
use ChunkifyAnalytics\Events\EventListParams\Order;
use ChunkifyAnalytics\Events\NativeCreated;
use ChunkifyAnalytics\Events\NativeDuplicate;
use ChunkifyAnalytics\Events\PlaybackError;
use ChunkifyAnalytics\Events\PlaybackStateChanged;
use ChunkifyAnalytics\Events\RenditionChanged;
use ChunkifyAnalytics\Events\SeekCompleted;
use ChunkifyAnalytics\Events\StoredEvent;
use ChunkifyAnalytics\Events\ViewEnded;
use ChunkifyAnalytics\Events\ViewSnapshot;
use ChunkifyAnalytics\Events\ViewStarted;
use ChunkifyAnalytics\EventsPage;
use ChunkifyAnalytics\RequestOptions;

/**
 * @phpstan-import-type AnalyticsEventShape from \ChunkifyAnalytics\Events\AnalyticsEvent
 * @phpstan-import-type RequestOpts from \ChunkifyAnalytics\RequestOptions
 */
interface EventsContract
{
    /**
     * @api
     *
     * @param string $browserName Exact browser name, such as Chrome. Missing values do not match.
     * @param string $city Exact, case-sensitive city name from the local lookup, with 1 to 256 Unicode characters. Use country alongside city to distinguish places with the same name. Missing locations do not match.
     * @param Continent|value-of<Continent> $continent Exact continent code from the local lookup. Missing locations do not match.
     * @param string $country Exact uppercase ISO 3166-1 alpha-2 country code, such as GB. Missing locations do not match.
     * @param string $cursor Use next_cursor from the previous page. Keep the same filters, sort_by and order. Video cursors from earlier versions are invalid; start a new pagination sequence after upgrading.
     * @param DeviceType|value-of<DeviceType> $deviceType Exact device class. unknown matches an explicit unknown value.
     * @param EventName|value-of<EventName> $eventName Raw-event queries only. Summaries and videos reject this parameter.
     * @param \DateTimeInterface $from Inclusive RFC3339 occurrence-time lower bound, with timezone. Summary/video queries apply it to the selected view_started event. Must be before to.
     * @param int $limit Maximum rows on this page. Events and videos always support pagination; summary, quality and engagement support it only with group_by.
     * @param Order|value-of<Order> $order Sort direction. Events and videos default to asc; views default to desc. Events sort by ingestion sequence. Videos and views sort by sort_by with missing values last. View ties use view_id in the requested direction; video metric ties use video_id ascending.
     * @param string $osName Exact operating-system name, such as macOS. Missing values do not match.
     * @param string $pageOrigin Exact, case-sensitive page origin captured by the player, such as https://example.com. Metrics use the first retained view start; raw events use each event context. Missing values do not match.
     * @param string $pagePath Exact, case-sensitive page path captured by the player, such as /watch/video. Filter by page_origin as well to distinguish identical paths on different sites. Metrics use the first retained view start; raw events use each event context. Missing values do not match.
     * @param \DateTimeInterface $to Exclusive RFC3339 occurrence-time upper bound, with timezone. Summary/video queries apply it to the selected view_started event.
     * @param string $videoID Exact video ID. Combined with all other filters using AND.
     * @param string $viewID Filter one playback attempt by view ID. Metrics use its first retained start.
     * @param string $viewerID Exact supplied viewer ID. Missing/null viewer IDs do not match.
     * @param RequestOpts|null $requestOptions
     *
     * @return EventsPage<StoredEvent>
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
        EventName|string|null $eventName = null,
        ?\DateTimeInterface $from = null,
        int $limit = 100,
        Order|string $order = 'asc',
        ?string $osName = null,
        ?string $pageOrigin = null,
        ?string $pagePath = null,
        ?\DateTimeInterface $to = null,
        ?string $videoID = null,
        ?string $viewID = null,
        ?string $viewerID = null,
        RequestOptions|array|null $requestOptions = null,
    ): EventsPage;

    /**
     * @api
     *
     * @param AnalyticsEventShape $event Body param: A schema version 1 playback event. Extra properties are preserved.
     * @param ContentEncoding|value-of<ContentEncoding> $contentEncoding Header param: JSON requests accept an absent Content-Encoding header or identity. Compression is not supported.
     * @param string $origin Header param: Optional browser origin. When supplied it must exactly match server.allowed_origins. Origin-less server requests are allowed with the public key.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function ingest(
        ViewStarted|array|ViewSnapshot|PlaybackError|ViewEnded|PlaybackStateChanged|RenditionChanged|SeekCompleted $event,
        ContentEncoding|string|null $contentEncoding = null,
        ?string $origin = null,
        RequestOptions|array|null $requestOptions = null,
    ): NativeCreated|NativeDuplicate;
}
