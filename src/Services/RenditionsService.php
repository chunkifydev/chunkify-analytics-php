<?php

declare(strict_types=1);

namespace ChunkifyAnalytics\Services;

use ChunkifyAnalytics\Client;
use ChunkifyAnalytics\Core\Exceptions\APIException;
use ChunkifyAnalytics\Core\Util;
use ChunkifyAnalytics\Renditions\RenditionReport;
use ChunkifyAnalytics\Renditions\RenditionRetrieveParams\Continent;
use ChunkifyAnalytics\Renditions\RenditionRetrieveParams\DeviceType;
use ChunkifyAnalytics\RequestOptions;
use ChunkifyAnalytics\ServiceContracts\RenditionsContract;

/**
 * Private retained-event and view-cohort queries.
 *
 * @phpstan-import-type RequestOpts from \ChunkifyAnalytics\RequestOptions
 */
final class RenditionsService implements RenditionsContract
{
    /**
     * @api
     */
    public RenditionsRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new RenditionsRawService($client);
    }

    /**
     * @api
     *
     * Summarize rendition measurements for the filtered view-start cohort. Use only the selected final event, or latest snapshot when no final exists. Expand its cumulative rendition_playing_time array once per view. Missing or empty measurements contribute no rendition time. Rank by playing time descending; limit bounds returned rows only, while totals and average cover every matching rendition. Average bitrate is sum(bitrate_bps * playing_time_ms) divided by playing time with a known bitrate. Dimensions, codec, bitrate and frame rate together identify a rendition. Views can contribute to several renditions and must not be summed. No cursor, group_by, sort_by or order. Export resource=renditions includes all matching rows.
     *
     * @param string $browserName Exact browser name, such as Chrome. Missing values do not match.
     * @param string $city Exact, case-sensitive city name from the local lookup, with 1 to 256 Unicode characters. Use country alongside city to distinguish places with the same name. Missing locations do not match.
     * @param Continent|value-of<Continent> $continent Exact continent code from the local lookup. Missing locations do not match.
     * @param string $country Exact uppercase ISO 3166-1 alpha-2 country code, such as GB. Missing locations do not match.
     * @param DeviceType|value-of<DeviceType> $deviceType Exact device class. unknown matches an explicit unknown value.
     * @param \DateTimeInterface $from Inclusive RFC3339 occurrence-time lower bound, with timezone. Summary/video queries apply it to the selected view_started event. Must be before to.
     * @param int $limit Maximum rows on this page. Events and videos always support pagination; summary, quality and engagement support it only with group_by.
     * @param string $osName Exact operating-system name, such as macOS. Missing values do not match.
     * @param string $pageOrigin Exact, case-sensitive page origin captured by the player, such as https://example.com. Metrics use the first retained view start; raw events use each event context. Missing values do not match.
     * @param string $pagePath Exact, case-sensitive page path captured by the player, such as /watch/video. Filter by page_origin as well to distinguish identical paths on different sites. Metrics use the first retained view start; raw events use each event context. Missing values do not match.
     * @param \DateTimeInterface $to Exclusive RFC3339 occurrence-time upper bound, with timezone. Summary/video queries apply it to the selected view_started event.
     * @param string $videoID Exact video ID. Combined with all other filters using AND.
     * @param string $viewID Filter one playback attempt by view ID. Metrics use its first retained start.
     * @param string $viewerID Exact supplied viewer ID. Missing/null viewer IDs do not match.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        ?string $browserName = null,
        ?string $city = null,
        Continent|string|null $continent = null,
        ?string $country = null,
        DeviceType|string|null $deviceType = null,
        ?\DateTimeInterface $from = null,
        int $limit = 100,
        ?string $osName = null,
        ?string $pageOrigin = null,
        ?string $pagePath = null,
        ?\DateTimeInterface $to = null,
        ?string $videoID = null,
        ?string $viewID = null,
        ?string $viewerID = null,
        RequestOptions|array|null $requestOptions = null,
    ): RenditionReport {
        $params = Util::removeNulls(
            [
                'browserName' => $browserName,
                'city' => $city,
                'continent' => $continent,
                'country' => $country,
                'deviceType' => $deviceType,
                'from' => $from,
                'limit' => $limit,
                'osName' => $osName,
                'pageOrigin' => $pageOrigin,
                'pagePath' => $pagePath,
                'to' => $to,
                'videoID' => $videoID,
                'viewID' => $viewID,
                'viewerID' => $viewerID,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieve(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
