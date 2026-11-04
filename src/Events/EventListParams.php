<?php

declare(strict_types=1);

namespace ChunkifyAnalytics\Events;

use ChunkifyAnalytics\Core\Attributes\Optional;
use ChunkifyAnalytics\Core\Concerns\SdkModel;
use ChunkifyAnalytics\Core\Concerns\SdkParams;
use ChunkifyAnalytics\Core\Contracts\BaseModel;
use ChunkifyAnalytics\Events\EventListParams\Continent;
use ChunkifyAnalytics\Events\EventListParams\DeviceType;
use ChunkifyAnalytics\Events\EventListParams\EventName;
use ChunkifyAnalytics\Events\EventListParams\Order;

/**
 * List project events with filters and pagination. Use order=desc for the newest events.
 *
 * @see ChunkifyAnalytics\Services\EventsService::list()
 *
 * @phpstan-type EventListParamsShape = array{
 *   browserName?: string|null,
 *   city?: string|null,
 *   continent?: null|Continent|value-of<Continent>,
 *   country?: string|null,
 *   cursor?: string|null,
 *   deviceType?: null|DeviceType|value-of<DeviceType>,
 *   eventName?: null|EventName|value-of<EventName>,
 *   from?: \DateTimeInterface|null,
 *   limit?: int|null,
 *   order?: null|Order|value-of<Order>,
 *   osName?: string|null,
 *   pageOrigin?: string|null,
 *   pagePath?: string|null,
 *   to?: \DateTimeInterface|null,
 *   videoID?: string|null,
 *   viewID?: string|null,
 *   viewerID?: string|null,
 * }
 */
final class EventListParams implements BaseModel
{
    /** @use SdkModel<EventListParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Exact browser name, such as Chrome. Missing values do not match.
     */
    #[Optional]
    public ?string $browserName;

    /**
     * Exact, case-sensitive city name from the local lookup, with 1 to 256 Unicode characters. Use country alongside city to distinguish places with the same name. Missing locations do not match.
     */
    #[Optional]
    public ?string $city;

    /**
     * Exact continent code from the local lookup. Missing locations do not match.
     *
     * @var value-of<Continent>|null $continent
     */
    #[Optional(enum: Continent::class)]
    public ?string $continent;

    /**
     * Exact uppercase ISO 3166-1 alpha-2 country code, such as GB. Missing locations do not match.
     */
    #[Optional]
    public ?string $country;

    /**
     * Use next_cursor from the previous page. Keep the same filters, sort_by and order. Video cursors from earlier versions are invalid; start a new pagination sequence after upgrading.
     */
    #[Optional]
    public ?string $cursor;

    /**
     * Exact device class. unknown matches an explicit unknown value.
     *
     * @var value-of<DeviceType>|null $deviceType
     */
    #[Optional(enum: DeviceType::class)]
    public ?string $deviceType;

    /**
     * Raw-event queries only. Summaries and videos reject this parameter.
     *
     * @var value-of<EventName>|null $eventName
     */
    #[Optional(enum: EventName::class)]
    public ?string $eventName;

    /**
     * Inclusive RFC3339 occurrence-time lower bound, with timezone. Summary/video queries apply it to the selected view_started event. Must be before to.
     */
    #[Optional]
    public ?\DateTimeInterface $from;

    /**
     * Maximum rows on this page. Events and videos always support pagination; summary, quality and engagement support it only with group_by.
     */
    #[Optional]
    public ?int $limit;

    /**
     * Sort direction. Events and videos default to asc; views default to desc. Events sort by ingestion sequence. Videos and views sort by sort_by with missing values last. View ties use view_id in the requested direction; video metric ties use video_id ascending.
     *
     * @var value-of<Order>|null $order
     */
    #[Optional(enum: Order::class)]
    public ?string $order;

    /**
     * Exact operating-system name, such as macOS. Missing values do not match.
     */
    #[Optional]
    public ?string $osName;

    /**
     * Exact, case-sensitive page origin captured by the player, such as https://example.com. Metrics use the first retained view start; raw events use each event context. Missing values do not match.
     */
    #[Optional]
    public ?string $pageOrigin;

    /**
     * Exact, case-sensitive page path captured by the player, such as /watch/video. Filter by page_origin as well to distinguish identical paths on different sites. Metrics use the first retained view start; raw events use each event context. Missing values do not match.
     */
    #[Optional]
    public ?string $pagePath;

    /**
     * Exclusive RFC3339 occurrence-time upper bound, with timezone. Summary/video queries apply it to the selected view_started event.
     */
    #[Optional]
    public ?\DateTimeInterface $to;

    /**
     * Exact video ID. Combined with all other filters using AND.
     */
    #[Optional]
    public ?string $videoID;

    /**
     * Filter one playback attempt by view ID. Metrics use its first retained start.
     */
    #[Optional]
    public ?string $viewID;

    /**
     * Exact supplied viewer ID. Missing/null viewer IDs do not match.
     */
    #[Optional]
    public ?string $viewerID;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param Continent|value-of<Continent>|null $continent
     * @param DeviceType|value-of<DeviceType>|null $deviceType
     * @param EventName|value-of<EventName>|null $eventName
     * @param Order|value-of<Order>|null $order
     */
    public static function with(
        ?string $browserName = null,
        ?string $city = null,
        Continent|string|null $continent = null,
        ?string $country = null,
        ?string $cursor = null,
        DeviceType|string|null $deviceType = null,
        EventName|string|null $eventName = null,
        ?\DateTimeInterface $from = null,
        ?int $limit = null,
        Order|string|null $order = null,
        ?string $osName = null,
        ?string $pageOrigin = null,
        ?string $pagePath = null,
        ?\DateTimeInterface $to = null,
        ?string $videoID = null,
        ?string $viewID = null,
        ?string $viewerID = null,
    ): self {
        $self = new self;

        null !== $browserName && $self['browserName'] = $browserName;
        null !== $city && $self['city'] = $city;
        null !== $continent && $self['continent'] = $continent;
        null !== $country && $self['country'] = $country;
        null !== $cursor && $self['cursor'] = $cursor;
        null !== $deviceType && $self['deviceType'] = $deviceType;
        null !== $eventName && $self['eventName'] = $eventName;
        null !== $from && $self['from'] = $from;
        null !== $limit && $self['limit'] = $limit;
        null !== $order && $self['order'] = $order;
        null !== $osName && $self['osName'] = $osName;
        null !== $pageOrigin && $self['pageOrigin'] = $pageOrigin;
        null !== $pagePath && $self['pagePath'] = $pagePath;
        null !== $to && $self['to'] = $to;
        null !== $videoID && $self['videoID'] = $videoID;
        null !== $viewID && $self['viewID'] = $viewID;
        null !== $viewerID && $self['viewerID'] = $viewerID;

        return $self;
    }

    /**
     * Exact browser name, such as Chrome. Missing values do not match.
     */
    public function withBrowserName(string $browserName): self
    {
        $self = clone $this;
        $self['browserName'] = $browserName;

        return $self;
    }

    /**
     * Exact, case-sensitive city name from the local lookup, with 1 to 256 Unicode characters. Use country alongside city to distinguish places with the same name. Missing locations do not match.
     */
    public function withCity(string $city): self
    {
        $self = clone $this;
        $self['city'] = $city;

        return $self;
    }

    /**
     * Exact continent code from the local lookup. Missing locations do not match.
     *
     * @param Continent|value-of<Continent> $continent
     */
    public function withContinent(Continent|string $continent): self
    {
        $self = clone $this;
        $self['continent'] = $continent;

        return $self;
    }

    /**
     * Exact uppercase ISO 3166-1 alpha-2 country code, such as GB. Missing locations do not match.
     */
    public function withCountry(string $country): self
    {
        $self = clone $this;
        $self['country'] = $country;

        return $self;
    }

    /**
     * Use next_cursor from the previous page. Keep the same filters, sort_by and order. Video cursors from earlier versions are invalid; start a new pagination sequence after upgrading.
     */
    public function withCursor(string $cursor): self
    {
        $self = clone $this;
        $self['cursor'] = $cursor;

        return $self;
    }

    /**
     * Exact device class. unknown matches an explicit unknown value.
     *
     * @param DeviceType|value-of<DeviceType> $deviceType
     */
    public function withDeviceType(DeviceType|string $deviceType): self
    {
        $self = clone $this;
        $self['deviceType'] = $deviceType;

        return $self;
    }

    /**
     * Raw-event queries only. Summaries and videos reject this parameter.
     *
     * @param EventName|value-of<EventName> $eventName
     */
    public function withEventName(EventName|string $eventName): self
    {
        $self = clone $this;
        $self['eventName'] = $eventName;

        return $self;
    }

    /**
     * Inclusive RFC3339 occurrence-time lower bound, with timezone. Summary/video queries apply it to the selected view_started event. Must be before to.
     */
    public function withFrom(\DateTimeInterface $from): self
    {
        $self = clone $this;
        $self['from'] = $from;

        return $self;
    }

    /**
     * Maximum rows on this page. Events and videos always support pagination; summary, quality and engagement support it only with group_by.
     */
    public function withLimit(int $limit): self
    {
        $self = clone $this;
        $self['limit'] = $limit;

        return $self;
    }

    /**
     * Sort direction. Events and videos default to asc; views default to desc. Events sort by ingestion sequence. Videos and views sort by sort_by with missing values last. View ties use view_id in the requested direction; video metric ties use video_id ascending.
     *
     * @param Order|value-of<Order> $order
     */
    public function withOrder(Order|string $order): self
    {
        $self = clone $this;
        $self['order'] = $order;

        return $self;
    }

    /**
     * Exact operating-system name, such as macOS. Missing values do not match.
     */
    public function withOsName(string $osName): self
    {
        $self = clone $this;
        $self['osName'] = $osName;

        return $self;
    }

    /**
     * Exact, case-sensitive page origin captured by the player, such as https://example.com. Metrics use the first retained view start; raw events use each event context. Missing values do not match.
     */
    public function withPageOrigin(string $pageOrigin): self
    {
        $self = clone $this;
        $self['pageOrigin'] = $pageOrigin;

        return $self;
    }

    /**
     * Exact, case-sensitive page path captured by the player, such as /watch/video. Filter by page_origin as well to distinguish identical paths on different sites. Metrics use the first retained view start; raw events use each event context. Missing values do not match.
     */
    public function withPagePath(string $pagePath): self
    {
        $self = clone $this;
        $self['pagePath'] = $pagePath;

        return $self;
    }

    /**
     * Exclusive RFC3339 occurrence-time upper bound, with timezone. Summary/video queries apply it to the selected view_started event.
     */
    public function withTo(\DateTimeInterface $to): self
    {
        $self = clone $this;
        $self['to'] = $to;

        return $self;
    }

    /**
     * Exact video ID. Combined with all other filters using AND.
     */
    public function withVideoID(string $videoID): self
    {
        $self = clone $this;
        $self['videoID'] = $videoID;

        return $self;
    }

    /**
     * Filter one playback attempt by view ID. Metrics use its first retained start.
     */
    public function withViewID(string $viewID): self
    {
        $self = clone $this;
        $self['viewID'] = $viewID;

        return $self;
    }

    /**
     * Exact supplied viewer ID. Missing/null viewer IDs do not match.
     */
    public function withViewerID(string $viewerID): self
    {
        $self = clone $this;
        $self['viewerID'] = $viewerID;

        return $self;
    }
}
