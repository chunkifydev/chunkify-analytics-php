<?php

declare(strict_types=1);

namespace ChunkifyAnalytics\Quality;

use ChunkifyAnalytics\Core\Attributes\Optional;
use ChunkifyAnalytics\Core\Concerns\SdkModel;
use ChunkifyAnalytics\Core\Concerns\SdkParams;
use ChunkifyAnalytics\Core\Contracts\BaseModel;
use ChunkifyAnalytics\Quality\QualityRetrieveParams\Continent;
use ChunkifyAnalytics\Quality\QualityRetrieveParams\DeviceType;
use ChunkifyAnalytics\Quality\QualityRetrieveParams\GroupBy;

/**
 * Get startup time, buffering, and observed fatal errors for matching playback attempts. Null means unavailable. Optionally group the full filtered view-start cohort with group_by=browser_name, os_name, device_type, continent, country or city. Without group_by the totals response is unchanged. With group_by, return paginated groups sorted by views descending. Equal view counts sort by value ascending, null first. Context comes from the first retained start; missing, null and nonstring values form a null group. Keep group_by and filters unchanged with each cursor. Unique viewers must not be summed across groups. Includes mutually exclusive startup outcomes; unknown outcomes remain explicit.
 *
 * @see ChunkifyAnalytics\Services\QualityService::retrieve()
 *
 * @phpstan-type QualityRetrieveParamsShape = array{
 *   browserName?: string|null,
 *   city?: string|null,
 *   continent?: null|Continent|value-of<Continent>,
 *   country?: string|null,
 *   cursor?: string|null,
 *   deviceType?: null|DeviceType|value-of<DeviceType>,
 *   from?: \DateTimeInterface|null,
 *   groupBy?: string|null|GroupBy|value-of<GroupBy>,
 *   limit?: int|null,
 *   osName?: string|null,
 *   pageOrigin?: string|null,
 *   pagePath?: string|null,
 *   playbackRate?: string|null,
 *   subtitleLanguage?: string|null,
 *   to?: \DateTimeInterface|null,
 *   userID?: string|null,
 *   videoID?: string|null,
 *   videoTitle?: string|null,
 *   viewID?: string|null,
 *   viewerID?: string|null,
 * }
 */
final class QualityRetrieveParams implements BaseModel
{
    /** @use SdkModel<QualityRetrieveParamsShape> */
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
     * Inclusive RFC3339 occurrence-time lower bound, with timezone. Summary/video queries apply it to the selected view_started event. Must be before to.
     */
    #[Optional]
    public ?\DateTimeInterface $from;

    /**
     * Optional on summary, quality and engagement. Group views by this field on their first retained start. Missing, null and nonstring context forms a null group; the literal device type unknown stays separate. Groups sort by views descending, then value ascending with null first for ties. Pagination is available only with group_by. Location uses the first retained start too. City groups use the stored name; filter by country to avoid combining names shared by different countries. Page groups use the first retained start even if playback continues after navigation. Filter by page_origin when grouping page_path to distinguish identical paths on different sites. video_title groups by the title on each view's first retained start, so a renamed video counts each view under the title it started with. user_id groups by the user ID on each view's first retained start. Use custom.<key>, such as custom.plan, to group by a custom dimension; views without the key form the null group.
     *
     * @var string|value-of<GroupBy>|null $groupBy
     */
    #[Optional(enum: GroupBy::class)]
    public ?string $groupBy;

    /**
     * Maximum rows on this page. Events and videos always support pagination; summary, quality and engagement support it only with group_by.
     */
    #[Optional]
    public ?int $limit;

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
     * Exact video ID; must not be blank. Combined with all other filters using AND.
     */
    #[Optional]
    public ?string $videoID;

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
     * @param string|GroupBy|value-of<GroupBy>|null $groupBy
     */
    public static function with(
        ?string $browserName = null,
        ?string $city = null,
        Continent|string|null $continent = null,
        ?string $country = null,
        ?string $cursor = null,
        DeviceType|string|null $deviceType = null,
        ?\DateTimeInterface $from = null,
        GroupBy|string|null $groupBy = null,
        ?int $limit = null,
        ?string $osName = null,
        ?string $pageOrigin = null,
        ?string $pagePath = null,
        ?string $playbackRate = null,
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
        null !== $cursor && $self['cursor'] = $cursor;
        null !== $deviceType && $self['deviceType'] = $deviceType;
        null !== $from && $self['from'] = $from;
        null !== $groupBy && $self['groupBy'] = $groupBy;
        null !== $limit && $self['limit'] = $limit;
        null !== $osName && $self['osName'] = $osName;
        null !== $pageOrigin && $self['pageOrigin'] = $pageOrigin;
        null !== $pagePath && $self['pagePath'] = $pagePath;
        null !== $playbackRate && $self['playbackRate'] = $playbackRate;
        null !== $subtitleLanguage && $self['subtitleLanguage'] = $subtitleLanguage;
        null !== $to && $self['to'] = $to;
        null !== $userID && $self['userID'] = $userID;
        null !== $videoID && $self['videoID'] = $videoID;
        null !== $videoTitle && $self['videoTitle'] = $videoTitle;
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
     * Inclusive RFC3339 occurrence-time lower bound, with timezone. Summary/video queries apply it to the selected view_started event. Must be before to.
     */
    public function withFrom(\DateTimeInterface $from): self
    {
        $self = clone $this;
        $self['from'] = $from;

        return $self;
    }

    /**
     * Optional on summary, quality and engagement. Group views by this field on their first retained start. Missing, null and nonstring context forms a null group; the literal device type unknown stays separate. Groups sort by views descending, then value ascending with null first for ties. Pagination is available only with group_by. Location uses the first retained start too. City groups use the stored name; filter by country to avoid combining names shared by different countries. Page groups use the first retained start even if playback continues after navigation. Filter by page_origin when grouping page_path to distinguish identical paths on different sites. video_title groups by the title on each view's first retained start, so a renamed video counts each view under the title it started with. user_id groups by the user ID on each view's first retained start. Use custom.<key>, such as custom.plan, to group by a custom dimension; views without the key form the null group.
     *
     * @param string|GroupBy|value-of<GroupBy> $groupBy
     */
    public function withGroupBy(GroupBy|string $groupBy): self
    {
        $self = clone $this;
        $self['groupBy'] = $groupBy;

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
     * Exact video ID; must not be blank. Combined with all other filters using AND.
     */
    public function withVideoID(string $videoID): self
    {
        $self = clone $this;
        $self['videoID'] = $videoID;

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
