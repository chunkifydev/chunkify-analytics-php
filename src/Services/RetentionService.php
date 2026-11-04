<?php

declare(strict_types=1);

namespace ChunkifyAnalytics\Services;

use ChunkifyAnalytics\Client;
use ChunkifyAnalytics\Core\Exceptions\APIException;
use ChunkifyAnalytics\Core\Util;
use ChunkifyAnalytics\RequestOptions;
use ChunkifyAnalytics\Retention\RetentionReport;
use ChunkifyAnalytics\Retention\RetentionRetrieveParams\Continent;
use ChunkifyAnalytics\Retention\RetentionRetrieveParams\DeviceType;
use ChunkifyAnalytics\ServiceContracts\RetentionContract;

/**
 * Private retained-event and view-cohort queries.
 *
 * @phpstan-import-type RequestOpts from \ChunkifyAnalytics\RequestOptions
 */
final class RetentionService implements RetentionContract
{
    /**
     * @api
     */
    public RetentionRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new RetentionRawService($client);
    }

    /**
     * @api
     *
     * Count views along the video using recorded played ranges. Requires video_id. Uses the final measurement, or the latest snapshot without an end event, for each retained start matching the date and audience filters. Each attempt counts once in each section it overlapped, including replays. Skipped sections do not count. Older events without played ranges and attempts without a finite positive duration are excluded from sample_views. Returns at most 200 consecutive buckets, including zero counts, at a width of at least one second. This is media position, not wall-clock time.
     *
     * @param string $videoID Video to report. Retention measures one video at a time.
     * @param string $browserName Exact browser name, such as Chrome. Missing values do not match.
     * @param string $city Exact, case-sensitive city name from the local lookup, with 1 to 256 Unicode characters. Use country alongside city to distinguish places with the same name. Missing locations do not match.
     * @param Continent|value-of<Continent> $continent Exact continent code from the local lookup. Missing locations do not match.
     * @param string $country Exact uppercase ISO 3166-1 alpha-2 country code, such as GB. Missing locations do not match.
     * @param DeviceType|value-of<DeviceType> $deviceType Exact device class. unknown matches an explicit unknown value.
     * @param \DateTimeInterface $from Inclusive RFC3339 occurrence-time lower bound, with timezone. Summary/video queries apply it to the selected view_started event. Must be before to.
     * @param string $osName Exact operating-system name, such as macOS. Missing values do not match.
     * @param string $pageOrigin Exact, case-sensitive page origin captured by the player, such as https://example.com. Metrics use the first retained view start; raw events use each event context. Missing values do not match.
     * @param string $pagePath Exact, case-sensitive page path captured by the player, such as /watch/video. Filter by page_origin as well to distinguish identical paths on different sites. Metrics use the first retained view start; raw events use each event context. Missing values do not match.
     * @param \DateTimeInterface $to Exclusive RFC3339 occurrence-time upper bound, with timezone. Summary/video queries apply it to the selected view_started event.
     * @param string $viewID Filter one playback attempt by view ID. Metrics use its first retained start.
     * @param string $viewerID Exact supplied viewer ID. Missing/null viewer IDs do not match.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
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
        ?\DateTimeInterface $to = null,
        ?string $viewID = null,
        ?string $viewerID = null,
        RequestOptions|array|null $requestOptions = null,
    ): RetentionReport {
        $params = Util::removeNulls(
            [
                'videoID' => $videoID,
                'browserName' => $browserName,
                'city' => $city,
                'continent' => $continent,
                'country' => $country,
                'deviceType' => $deviceType,
                'from' => $from,
                'osName' => $osName,
                'pageOrigin' => $pageOrigin,
                'pagePath' => $pagePath,
                'to' => $to,
                'viewID' => $viewID,
                'viewerID' => $viewerID,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieve(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
