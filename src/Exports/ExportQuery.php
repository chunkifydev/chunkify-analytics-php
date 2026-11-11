<?php

declare(strict_types=1);

namespace ChunkifyAnalytics\Exports;

use ChunkifyAnalytics\Core\Attributes\Optional;
use ChunkifyAnalytics\Core\Concerns\SdkModel;
use ChunkifyAnalytics\Core\Contracts\BaseModel;
use ChunkifyAnalytics\Exports\ExportQuery\Continent;
use ChunkifyAnalytics\Exports\ExportQuery\DeviceType;
use ChunkifyAnalytics\Exports\ExportQuery\Dimension;
use ChunkifyAnalytics\Exports\ExportQuery\EventName;
use ChunkifyAnalytics\Exports\ExportQuery\GroupBy;
use ChunkifyAnalytics\Exports\ExportQuery\Interval;
use ChunkifyAnalytics\Exports\ExportQuery\Kind;
use ChunkifyAnalytics\Exports\ExportQuery\Order;
use ChunkifyAnalytics\Exports\ExportQuery\SortBy;

/**
 * @phpstan-type ExportQueryShape = array{
 *   browserName?: string|null,
 *   city?: string|null,
 *   continent?: null|Continent|value-of<Continent>,
 *   country?: string|null,
 *   deviceType?: null|DeviceType|value-of<DeviceType>,
 *   dimension?: string|null|Dimension|value-of<Dimension>,
 *   eventName?: null|EventName|value-of<EventName>,
 *   from?: \DateTimeInterface|null,
 *   groupBy?: string|null|GroupBy|value-of<GroupBy>,
 *   hasFatalError?: bool|null,
 *   interval?: null|Interval|value-of<Interval>,
 *   kind?: null|Kind|value-of<Kind>,
 *   order?: null|Order|value-of<Order>,
 *   osName?: string|null,
 *   pageOrigin?: string|null,
 *   pagePath?: string|null,
 *   playbackRate?: string|null,
 *   sortBy?: null|SortBy|value-of<SortBy>,
 *   subtitleLanguage?: string|null,
 *   to?: \DateTimeInterface|null,
 *   userID?: string|null,
 *   videoID?: string|null,
 *   videoTitle?: string|null,
 *   viewID?: string|null,
 *   viewerID?: string|null,
 * }
 */
final class ExportQuery implements BaseModel
{
    /** @use SdkModel<ExportQueryShape> */
    use SdkModel;

    #[Optional('browser_name')]
    public ?string $browserName;

    #[Optional]
    public ?string $city;

    /** @var value-of<Continent>|null $continent */
    #[Optional(enum: Continent::class)]
    public ?string $continent;

    #[Optional]
    public ?string $country;

    /** @var value-of<DeviceType>|null $deviceType */
    #[Optional('device_type', enum: DeviceType::class)]
    public ?string $deviceType;

    /**
     * One custom dimension's values, such as custom.plan.
     *
     * @var string|value-of<Dimension>|null $dimension
     */
    #[Optional(enum: Dimension::class)]
    public ?string $dimension;

    /** @var value-of<EventName>|null $eventName */
    #[Optional('event_name', enum: EventName::class)]
    public ?string $eventName;

    #[Optional]
    public ?\DateTimeInterface $from;

    /**
     * A custom dimension key, such as custom.plan.
     *
     * @var string|value-of<GroupBy>|null $groupBy
     */
    #[Optional('group_by', enum: GroupBy::class)]
    public ?string $groupBy;

    #[Optional('has_fatal_error')]
    public ?bool $hasFatalError;

    /** @var value-of<Interval>|null $interval */
    #[Optional(enum: Interval::class)]
    public ?string $interval;

    /** @var value-of<Kind>|null $kind */
    #[Optional(enum: Kind::class)]
    public ?string $kind;

    /** @var value-of<Order>|null $order */
    #[Optional(enum: Order::class)]
    public ?string $order;

    #[Optional('os_name')]
    public ?string $osName;

    /**
     * Exact, case-sensitive page_origin from the first retained view start, or each event for raw-event exports.
     */
    #[Optional('page_origin')]
    public ?string $pageOrigin;

    /**
     * Exact, case-sensitive page_path from the first retained view start, or each event for raw-event exports.
     */
    #[Optional('page_path')]
    public ?string $pagePath;

    #[Optional('playback_rate')]
    public ?string $playbackRate;

    /**
     * Videos or views only. Use a sort field supported by the selected resource. Defaults to video_id for videos and started_at for views.
     *
     * @var value-of<SortBy>|null $sortBy
     */
    #[Optional('sort_by', enum: SortBy::class)]
    public ?string $sortBy;

    #[Optional('subtitle_language')]
    public ?string $subtitleLanguage;

    #[Optional]
    public ?\DateTimeInterface $to;

    #[Optional('user_id')]
    public ?string $userID;

    #[Optional('video_id')]
    public ?string $videoID;

    #[Optional('video_title')]
    public ?string $videoTitle;

    #[Optional('view_id')]
    public ?string $viewID;

    #[Optional('viewer_id')]
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
     * @param string|Dimension|value-of<Dimension>|null $dimension
     * @param EventName|value-of<EventName>|null $eventName
     * @param string|GroupBy|value-of<GroupBy>|null $groupBy
     * @param Interval|value-of<Interval>|null $interval
     * @param Kind|value-of<Kind>|null $kind
     * @param Order|value-of<Order>|null $order
     * @param SortBy|value-of<SortBy>|null $sortBy
     */
    public static function with(
        ?string $browserName = null,
        ?string $city = null,
        Continent|string|null $continent = null,
        ?string $country = null,
        DeviceType|string|null $deviceType = null,
        Dimension|string|null $dimension = null,
        EventName|string|null $eventName = null,
        ?\DateTimeInterface $from = null,
        GroupBy|string|null $groupBy = null,
        ?bool $hasFatalError = null,
        Interval|string|null $interval = null,
        Kind|string|null $kind = null,
        Order|string|null $order = null,
        ?string $osName = null,
        ?string $pageOrigin = null,
        ?string $pagePath = null,
        ?string $playbackRate = null,
        SortBy|string|null $sortBy = null,
        ?string $subtitleLanguage = null,
        ?\DateTimeInterface $to = null,
        ?string $userID = null,
        ?string $videoID = null,
        ?string $videoTitle = null,
        ?string $viewID = null,
        ?string $viewerID = null,
    ): self {
        $self = new self;

        null !== $browserName && $self['browserName'] = $browserName;
        null !== $city && $self['city'] = $city;
        null !== $continent && $self['continent'] = $continent;
        null !== $country && $self['country'] = $country;
        null !== $deviceType && $self['deviceType'] = $deviceType;
        null !== $dimension && $self['dimension'] = $dimension;
        null !== $eventName && $self['eventName'] = $eventName;
        null !== $from && $self['from'] = $from;
        null !== $groupBy && $self['groupBy'] = $groupBy;
        null !== $hasFatalError && $self['hasFatalError'] = $hasFatalError;
        null !== $interval && $self['interval'] = $interval;
        null !== $kind && $self['kind'] = $kind;
        null !== $order && $self['order'] = $order;
        null !== $osName && $self['osName'] = $osName;
        null !== $pageOrigin && $self['pageOrigin'] = $pageOrigin;
        null !== $pagePath && $self['pagePath'] = $pagePath;
        null !== $playbackRate && $self['playbackRate'] = $playbackRate;
        null !== $sortBy && $self['sortBy'] = $sortBy;
        null !== $subtitleLanguage && $self['subtitleLanguage'] = $subtitleLanguage;
        null !== $to && $self['to'] = $to;
        null !== $userID && $self['userID'] = $userID;
        null !== $videoID && $self['videoID'] = $videoID;
        null !== $videoTitle && $self['videoTitle'] = $videoTitle;
        null !== $viewID && $self['viewID'] = $viewID;
        null !== $viewerID && $self['viewerID'] = $viewerID;

        return $self;
    }

    public function withBrowserName(string $browserName): self
    {
        $self = clone $this;
        $self['browserName'] = $browserName;

        return $self;
    }

    public function withCity(string $city): self
    {
        $self = clone $this;
        $self['city'] = $city;

        return $self;
    }

    /**
     * @param Continent|value-of<Continent> $continent
     */
    public function withContinent(Continent|string $continent): self
    {
        $self = clone $this;
        $self['continent'] = $continent;

        return $self;
    }

    public function withCountry(string $country): self
    {
        $self = clone $this;
        $self['country'] = $country;

        return $self;
    }

    /**
     * @param DeviceType|value-of<DeviceType> $deviceType
     */
    public function withDeviceType(DeviceType|string $deviceType): self
    {
        $self = clone $this;
        $self['deviceType'] = $deviceType;

        return $self;
    }

    /**
     * One custom dimension's values, such as custom.plan.
     *
     * @param string|Dimension|value-of<Dimension> $dimension
     */
    public function withDimension(Dimension|string $dimension): self
    {
        $self = clone $this;
        $self['dimension'] = $dimension;

        return $self;
    }

    /**
     * @param EventName|value-of<EventName> $eventName
     */
    public function withEventName(EventName|string $eventName): self
    {
        $self = clone $this;
        $self['eventName'] = $eventName;

        return $self;
    }

    public function withFrom(\DateTimeInterface $from): self
    {
        $self = clone $this;
        $self['from'] = $from;

        return $self;
    }

    /**
     * A custom dimension key, such as custom.plan.
     *
     * @param string|GroupBy|value-of<GroupBy> $groupBy
     */
    public function withGroupBy(GroupBy|string $groupBy): self
    {
        $self = clone $this;
        $self['groupBy'] = $groupBy;

        return $self;
    }

    public function withHasFatalError(bool $hasFatalError): self
    {
        $self = clone $this;
        $self['hasFatalError'] = $hasFatalError;

        return $self;
    }

    /**
     * @param Interval|value-of<Interval> $interval
     */
    public function withInterval(Interval|string $interval): self
    {
        $self = clone $this;
        $self['interval'] = $interval;

        return $self;
    }

    /**
     * @param Kind|value-of<Kind> $kind
     */
    public function withKind(Kind|string $kind): self
    {
        $self = clone $this;
        $self['kind'] = $kind;

        return $self;
    }

    /**
     * @param Order|value-of<Order> $order
     */
    public function withOrder(Order|string $order): self
    {
        $self = clone $this;
        $self['order'] = $order;

        return $self;
    }

    public function withOsName(string $osName): self
    {
        $self = clone $this;
        $self['osName'] = $osName;

        return $self;
    }

    /**
     * Exact, case-sensitive page_origin from the first retained view start, or each event for raw-event exports.
     */
    public function withPageOrigin(string $pageOrigin): self
    {
        $self = clone $this;
        $self['pageOrigin'] = $pageOrigin;

        return $self;
    }

    /**
     * Exact, case-sensitive page_path from the first retained view start, or each event for raw-event exports.
     */
    public function withPagePath(string $pagePath): self
    {
        $self = clone $this;
        $self['pagePath'] = $pagePath;

        return $self;
    }

    public function withPlaybackRate(string $playbackRate): self
    {
        $self = clone $this;
        $self['playbackRate'] = $playbackRate;

        return $self;
    }

    /**
     * Videos or views only. Use a sort field supported by the selected resource. Defaults to video_id for videos and started_at for views.
     *
     * @param SortBy|value-of<SortBy> $sortBy
     */
    public function withSortBy(SortBy|string $sortBy): self
    {
        $self = clone $this;
        $self['sortBy'] = $sortBy;

        return $self;
    }

    public function withSubtitleLanguage(string $subtitleLanguage): self
    {
        $self = clone $this;
        $self['subtitleLanguage'] = $subtitleLanguage;

        return $self;
    }

    public function withTo(\DateTimeInterface $to): self
    {
        $self = clone $this;
        $self['to'] = $to;

        return $self;
    }

    public function withUserID(string $userID): self
    {
        $self = clone $this;
        $self['userID'] = $userID;

        return $self;
    }

    public function withVideoID(string $videoID): self
    {
        $self = clone $this;
        $self['videoID'] = $videoID;

        return $self;
    }

    public function withVideoTitle(string $videoTitle): self
    {
        $self = clone $this;
        $self['videoTitle'] = $videoTitle;

        return $self;
    }

    public function withViewID(string $viewID): self
    {
        $self = clone $this;
        $self['viewID'] = $viewID;

        return $self;
    }

    public function withViewerID(string $viewerID): self
    {
        $self = clone $this;
        $self['viewerID'] = $viewerID;

        return $self;
    }
}
