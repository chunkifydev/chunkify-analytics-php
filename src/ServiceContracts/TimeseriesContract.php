<?php

declare(strict_types=1);

namespace ChunkifyAnalytics\ServiceContracts;

use ChunkifyAnalytics\Core\Exceptions\APIException;
use ChunkifyAnalytics\RequestOptions;
use ChunkifyAnalytics\Timeseries\EngagementTimeseries;
use ChunkifyAnalytics\Timeseries\QualityTimeseries;
use ChunkifyAnalytics\Timeseries\Timeseries;
use ChunkifyAnalytics\Timeseries\TimeseryRetrieveParams\Continent;
use ChunkifyAnalytics\Timeseries\TimeseryRetrieveParams\DeviceType;
use ChunkifyAnalytics\Timeseries\TimeseryRetrieveParams\Interval;
use ChunkifyAnalytics\Timeseries\TimeseryRetrieveParams\Kind;

/**
 * @phpstan-import-type RequestOpts from \ChunkifyAnalytics\RequestOptions
 */
interface TimeseriesContract
{
    /**
     * @api
     *
     * @param \DateTimeInterface $from inclusive view-start time in RFC3339 format with a timezone
     * @param Interval|value-of<Interval> $interval UTC hour or day. The requested range can contain at most 1000 buckets.
     * @param \DateTimeInterface $to Exclusive view-start time in RFC3339 format with a timezone. Must be later than from.
     * @param string $browserName Exact browser name, such as Chrome. Missing values do not match.
     * @param string $city Exact, case-sensitive city name from the local lookup, with 1 to 256 Unicode characters. Use country alongside city to distinguish places with the same name. Missing locations do not match.
     * @param Continent|value-of<Continent> $continent Exact continent code from the local lookup. Missing locations do not match.
     * @param string $country Exact uppercase ISO 3166-1 alpha-2 country code, such as GB. Missing locations do not match.
     * @param DeviceType|value-of<DeviceType> $deviceType Exact device class. unknown matches an explicit unknown value.
     * @param Kind|value-of<Kind> $kind Metric set for every time bucket. Uses the same calculations and sample counts as the corresponding totals route.
     * @param string $osName Exact operating-system name, such as macOS. Missing values do not match.
     * @param string $pageOrigin Exact, case-sensitive page origin captured by the player, such as https://example.com. Metrics use the first retained view start; raw events use each event context. Missing values do not match.
     * @param string $pagePath Exact, case-sensitive page path captured by the player, such as /watch/video. Filter by page_origin as well to distinguish identical paths on different sites. Metrics use the first retained view start; raw events use each event context. Missing values do not match.
     * @param string $videoID Exact video ID. Combined with all other filters using AND.
     * @param string $viewID Filter one playback attempt by view ID. Metrics use its first retained start.
     * @param string $viewerID Exact supplied viewer ID. Missing/null viewer IDs do not match.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        \DateTimeInterface $from,
        Interval|string $interval,
        \DateTimeInterface $to,
        ?string $browserName = null,
        ?string $city = null,
        Continent|string|null $continent = null,
        ?string $country = null,
        DeviceType|string|null $deviceType = null,
        Kind|string $kind = 'summary',
        ?string $osName = null,
        ?string $pageOrigin = null,
        ?string $pagePath = null,
        ?string $videoID = null,
        ?string $viewID = null,
        ?string $viewerID = null,
        RequestOptions|array|null $requestOptions = null,
    ): Timeseries|QualityTimeseries|EngagementTimeseries;
}
