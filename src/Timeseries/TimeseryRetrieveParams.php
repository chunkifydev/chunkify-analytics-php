<?php

declare(strict_types=1);

namespace ChunkifyAnalytics\Timeseries;

use ChunkifyAnalytics\Core\Attributes\Optional;
use ChunkifyAnalytics\Core\Attributes\Required;
use ChunkifyAnalytics\Core\Concerns\SdkModel;
use ChunkifyAnalytics\Core\Concerns\SdkParams;
use ChunkifyAnalytics\Core\Contracts\BaseModel;
use ChunkifyAnalytics\Timeseries\TimeseryRetrieveParams\Continent;
use ChunkifyAnalytics\Timeseries\TimeseryRetrieveParams\DeviceType;
use ChunkifyAnalytics\Timeseries\TimeseryRetrieveParams\Interval;
use ChunkifyAnalytics\Timeseries\TimeseryRetrieveParams\Kind;

/**
 * Supply from, to and interval=hour|day. kind defaults to summary and also accepts quality or engagement. Every bucket selects first retained starts in its UTC interval and includes each selected view's whole retained measurement and errors, even after to. Empty buckets have zero counts and null unavailable measurements or ratios. At most 1000 buckets. Unique viewer counts are not additive.
 *
 * @see ChunkifyAnalytics\Services\TimeseriesService::retrieve()
 *
 * @phpstan-type TimeseryRetrieveParamsShape = array{
 *   from: \DateTimeInterface,
 *   interval: Interval|value-of<Interval>,
 *   to: \DateTimeInterface,
 *   browserName?: string|null,
 *   city?: string|null,
 *   continent?: null|Continent|value-of<Continent>,
 *   country?: string|null,
 *   deviceType?: null|DeviceType|value-of<DeviceType>,
 *   kind?: null|Kind|value-of<Kind>,
 *   osName?: string|null,
 *   pageOrigin?: string|null,
 *   pagePath?: string|null,
 *   videoID?: string|null,
 *   viewID?: string|null,
 *   viewerID?: string|null,
 * }
 */
final class TimeseryRetrieveParams implements BaseModel
{
    /** @use SdkModel<TimeseryRetrieveParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Inclusive view-start time in RFC3339 format with a timezone.
     */
    #[Required]
    public \DateTimeInterface $from;

    /**
     * UTC hour or day. The requested range can contain at most 1000 buckets.
     *
     * @var value-of<Interval> $interval
     */
    #[Required(enum: Interval::class)]
    public string $interval;

    /**
     * Exclusive view-start time in RFC3339 format with a timezone. Must be later than from.
     */
    #[Required]
    public \DateTimeInterface $to;

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
     * Exact device class. unknown matches an explicit unknown value.
     *
     * @var value-of<DeviceType>|null $deviceType
     */
    #[Optional(enum: DeviceType::class)]
    public ?string $deviceType;

    /**
     * Metric set for every time bucket. Uses the same calculations and sample counts as the corresponding totals route.
     *
     * @var value-of<Kind>|null $kind
     */
    #[Optional(enum: Kind::class)]
    public ?string $kind;

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

    /**
     * `new TimeseryRetrieveParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * TimeseryRetrieveParams::with(from: ..., interval: ..., to: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new TimeseryRetrieveParams)->withFrom(...)->withInterval(...)->withTo(...)
     * ```
     */
    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param Interval|value-of<Interval> $interval
     * @param Continent|value-of<Continent>|null $continent
     * @param DeviceType|value-of<DeviceType>|null $deviceType
     * @param Kind|value-of<Kind>|null $kind
     */
    public static function with(
        \DateTimeInterface $from,
        Interval|string $interval,
        \DateTimeInterface $to,
        ?string $browserName = null,
        ?string $city = null,
        Continent|string|null $continent = null,
        ?string $country = null,
        DeviceType|string|null $deviceType = null,
        Kind|string|null $kind = null,
        ?string $osName = null,
        ?string $pageOrigin = null,
        ?string $pagePath = null,
        ?string $videoID = null,
        ?string $viewID = null,
        ?string $viewerID = null,
    ): self {
        $self = new self;

        $self['from'] = $from;
        $self['interval'] = $interval;
        $self['to'] = $to;

        null !== $browserName && $self['browserName'] = $browserName;
        null !== $city && $self['city'] = $city;
        null !== $continent && $self['continent'] = $continent;
        null !== $country && $self['country'] = $country;
        null !== $deviceType && $self['deviceType'] = $deviceType;
        null !== $kind && $self['kind'] = $kind;
        null !== $osName && $self['osName'] = $osName;
        null !== $pageOrigin && $self['pageOrigin'] = $pageOrigin;
        null !== $pagePath && $self['pagePath'] = $pagePath;
        null !== $videoID && $self['videoID'] = $videoID;
        null !== $viewID && $self['viewID'] = $viewID;
        null !== $viewerID && $self['viewerID'] = $viewerID;

        return $self;
    }

    /**
     * Inclusive view-start time in RFC3339 format with a timezone.
     */
    public function withFrom(\DateTimeInterface $from): self
    {
        $self = clone $this;
        $self['from'] = $from;

        return $self;
    }

    /**
     * UTC hour or day. The requested range can contain at most 1000 buckets.
     *
     * @param Interval|value-of<Interval> $interval
     */
    public function withInterval(Interval|string $interval): self
    {
        $self = clone $this;
        $self['interval'] = $interval;

        return $self;
    }

    /**
     * Exclusive view-start time in RFC3339 format with a timezone. Must be later than from.
     */
    public function withTo(\DateTimeInterface $to): self
    {
        $self = clone $this;
        $self['to'] = $to;

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
     * Metric set for every time bucket. Uses the same calculations and sample counts as the corresponding totals route.
     *
     * @param Kind|value-of<Kind> $kind
     */
    public function withKind(Kind|string $kind): self
    {
        $self = clone $this;
        $self['kind'] = $kind;

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
