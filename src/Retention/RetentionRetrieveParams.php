<?php

declare(strict_types=1);

namespace ChunkifyAnalytics\Retention;

use ChunkifyAnalytics\Core\Attributes\Optional;
use ChunkifyAnalytics\Core\Attributes\Required;
use ChunkifyAnalytics\Core\Concerns\SdkModel;
use ChunkifyAnalytics\Core\Concerns\SdkParams;
use ChunkifyAnalytics\Core\Contracts\BaseModel;
use ChunkifyAnalytics\Retention\RetentionRetrieveParams\Continent;
use ChunkifyAnalytics\Retention\RetentionRetrieveParams\DeviceType;

/**
 * Count views along the video using recorded played ranges. Requires video_id. Uses the final measurement, or the latest snapshot without an end event, for each retained start matching the date and audience filters. Each attempt counts once in each section it overlapped, including replays. Skipped sections do not count. Older events without played ranges and attempts without a finite positive duration are excluded from sample_views. Returns at most 200 consecutive buckets, including zero counts, at a width of at least one second. This is media position, not wall-clock time.
 *
 * @see ChunkifyAnalytics\Services\RetentionService::retrieve()
 *
 * @phpstan-type RetentionRetrieveParamsShape = array{
 *   videoID: string,
 *   browserName?: string|null,
 *   city?: string|null,
 *   continent?: null|Continent|value-of<Continent>,
 *   country?: string|null,
 *   deviceType?: null|DeviceType|value-of<DeviceType>,
 *   from?: \DateTimeInterface|null,
 *   osName?: string|null,
 *   pageOrigin?: string|null,
 *   pagePath?: string|null,
 *   playbackRate?: string|null,
 *   subtitleLanguage?: string|null,
 *   to?: \DateTimeInterface|null,
 *   userID?: string|null,
 *   videoTitle?: string|null,
 *   viewID?: string|null,
 *   viewerID?: string|null,
 * }
 */
final class RetentionRetrieveParams implements BaseModel
{
    /** @use SdkModel<RetentionRetrieveParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Video to report. Retention measures one video at a time.
     */
    #[Required]
    public string $videoID;

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
     * Inclusive RFC3339 occurrence-time lower bound, with timezone. Summary/video queries apply it to the selected view_started event. Must be before to.
     */
    #[Optional]
    public ?\DateTimeInterface $from;

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
     * Playback rate from 0.01 to 16 with at most two decimals, such as 1, 1.5 or 2; 2.0 and 2 are the same rate. Metrics use the rate on the first retained view start; raw events use each event's value.
     */
    #[Optional]
    public ?string $playbackRate;

    /**
     * Exact, case-sensitive, non-blank subtitle language tag, such as fr or en-US; und for a subtitles track without a language. Metrics use the language showing on the first retained view start; raw events use each event's value. Views without subtitles at start do not match.
     */
    #[Optional]
    public ?string $subtitleLanguage;

    /**
     * Exclusive RFC3339 occurrence-time upper bound, with timezone. Summary/video queries apply it to the selected view_started event.
     */
    #[Optional]
    public ?\DateTimeInterface $to;

    /**
     * Exact integrator-supplied user ID. Selects views by their start event; event lists match each event's own value. Missing/null user IDs do not match. Reports with this filter read one stored row per view.
     */
    #[Optional]
    public ?string $userID;

    /**
     * Exact, case-sensitive video title. Selects views by the title on their first retained start; event lists match each event's own value. Views without a title do not match. Reports with this filter read one stored row per view.
     */
    #[Optional]
    public ?string $videoTitle;

    /**
     * Filter one playback attempt by view ID. Metrics use its first retained start.
     */
    #[Optional]
    public ?string $viewID;

    /**
     * Exact viewer ID. The Chunkify player SDK generates one per browser; missing/null viewer IDs do not match.
     */
    #[Optional]
    public ?string $viewerID;

    /**
     * `new RetentionRetrieveParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * RetentionRetrieveParams::with(videoID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new RetentionRetrieveParams)->withVideoID(...)
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
     * @param Continent|value-of<Continent>|null $continent
     * @param DeviceType|value-of<DeviceType>|null $deviceType
     */
    public static function with(
        string $videoID,
        ?string $browserName = null,
        ?string $city = null,
        Continent|string|null $continent = null,
        ?string $country = null,
        DeviceType|string|null $deviceType = null,
        ?\DateTimeInterface $from = null,
        ?string $osName = null,
        ?string $pageOrigin = null,
        ?string $pagePath = null,
        ?string $playbackRate = null,
        ?string $subtitleLanguage = null,
        ?\DateTimeInterface $to = null,
        ?string $userID = null,
        ?string $videoTitle = null,
        ?string $viewID = null,
        ?string $viewerID = null,
    ): self {
        $self = new self;

        $self['videoID'] = $videoID;

        null !== $browserName && $self['browserName'] = $browserName;
        null !== $city && $self['city'] = $city;
        null !== $continent && $self['continent'] = $continent;
        null !== $country && $self['country'] = $country;
        null !== $deviceType && $self['deviceType'] = $deviceType;
        null !== $from && $self['from'] = $from;
        null !== $osName && $self['osName'] = $osName;
        null !== $pageOrigin && $self['pageOrigin'] = $pageOrigin;
        null !== $pagePath && $self['pagePath'] = $pagePath;
        null !== $playbackRate && $self['playbackRate'] = $playbackRate;
        null !== $subtitleLanguage && $self['subtitleLanguage'] = $subtitleLanguage;
        null !== $to && $self['to'] = $to;
        null !== $userID && $self['userID'] = $userID;
        null !== $videoTitle && $self['videoTitle'] = $videoTitle;
        null !== $viewID && $self['viewID'] = $viewID;
        null !== $viewerID && $self['viewerID'] = $viewerID;

        return $self;
    }

    /**
     * Video to report. Retention measures one video at a time.
     */
    public function withVideoID(string $videoID): self
    {
        $self = clone $this;
        $self['videoID'] = $videoID;

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
     * Inclusive RFC3339 occurrence-time lower bound, with timezone. Summary/video queries apply it to the selected view_started event. Must be before to.
     */
    public function withFrom(\DateTimeInterface $from): self
    {
        $self = clone $this;
        $self['from'] = $from;

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
     * Playback rate from 0.01 to 16 with at most two decimals, such as 1, 1.5 or 2; 2.0 and 2 are the same rate. Metrics use the rate on the first retained view start; raw events use each event's value.
     */
    public function withPlaybackRate(string $playbackRate): self
    {
        $self = clone $this;
        $self['playbackRate'] = $playbackRate;

        return $self;
    }

    /**
     * Exact, case-sensitive, non-blank subtitle language tag, such as fr or en-US; und for a subtitles track without a language. Metrics use the language showing on the first retained view start; raw events use each event's value. Views without subtitles at start do not match.
     */
    public function withSubtitleLanguage(string $subtitleLanguage): self
    {
        $self = clone $this;
        $self['subtitleLanguage'] = $subtitleLanguage;

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
     * Exact integrator-supplied user ID. Selects views by their start event; event lists match each event's own value. Missing/null user IDs do not match. Reports with this filter read one stored row per view.
     */
    public function withUserID(string $userID): self
    {
        $self = clone $this;
        $self['userID'] = $userID;

        return $self;
    }

    /**
     * Exact, case-sensitive video title. Selects views by the title on their first retained start; event lists match each event's own value. Views without a title do not match. Reports with this filter read one stored row per view.
     */
    public function withVideoTitle(string $videoTitle): self
    {
        $self = clone $this;
        $self['videoTitle'] = $videoTitle;

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
     * Exact viewer ID. The Chunkify player SDK generates one per browser; missing/null viewer IDs do not match.
     */
    public function withViewerID(string $viewerID): self
    {
        $self = clone $this;
        $self['viewerID'] = $viewerID;

        return $self;
    }
}
