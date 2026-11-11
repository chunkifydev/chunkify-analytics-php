<?php

declare(strict_types=1);

namespace ChunkifyAnalytics\Services;

use ChunkifyAnalytics\Client;
use ChunkifyAnalytics\Core\Exceptions\APIException;
use ChunkifyAnalytics\Core\Util;
use ChunkifyAnalytics\Quality\Quality;
use ChunkifyAnalytics\Quality\QualityBreakdownPage;
use ChunkifyAnalytics\Quality\QualityRetrieveParams\Continent;
use ChunkifyAnalytics\Quality\QualityRetrieveParams\DeviceType;
use ChunkifyAnalytics\Quality\QualityRetrieveParams\GroupBy;
use ChunkifyAnalytics\RequestOptions;
use ChunkifyAnalytics\ServiceContracts\QualityContract;

/**
 * Private retained-event and view-cohort queries.
 *
 * @phpstan-import-type RequestOpts from \ChunkifyAnalytics\RequestOptions
 */
final class QualityService implements QualityContract
{
    /**
     * @api
     */
    public QualityRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new QualityRawService($client);
    }

    /**
     * @api
     *
     * Get startup time, buffering, and observed fatal errors for matching playback attempts. Null means unavailable. Optionally group the full filtered view-start cohort with group_by=browser_name, os_name, device_type, continent, country or city. Without group_by the totals response is unchanged. With group_by, return paginated groups sorted by views descending. Equal view counts sort by value ascending, null first. Context comes from the first retained start; missing, null and nonstring values form a null group. Keep group_by and filters unchanged with each cursor. Unique viewers must not be summed across groups. Includes mutually exclusive startup outcomes; unknown outcomes remain explicit.
     *
     * @param string $browserName Exact browser name, such as Chrome. Missing values do not match.
     * @param string $city Exact, case-sensitive city name from the local lookup, with 1 to 256 Unicode characters. Use country alongside city to distinguish places with the same name. Missing locations do not match.
     * @param Continent|value-of<Continent> $continent Exact continent code from the local lookup. Missing locations do not match.
     * @param string $country Exact uppercase ISO 3166-1 alpha-2 country code, such as GB. Missing locations do not match.
     * @param string $cursor Use next_cursor from the previous page. Keep the same filters, sort_by and order. Video cursors from earlier versions are invalid; start a new pagination sequence after upgrading.
     * @param DeviceType|value-of<DeviceType> $deviceType Exact device class. unknown matches an explicit unknown value.
     * @param \DateTimeInterface $from Inclusive RFC3339 occurrence-time lower bound, with timezone. Summary/video queries apply it to the selected view_started event. Must be before to.
     * @param string|GroupBy|value-of<GroupBy> $groupBy Optional on summary, quality and engagement. Group views by this field on their first retained start. Missing, null and nonstring context forms a null group; the literal device type unknown stays separate. Groups sort by views descending, then value ascending with null first for ties. Pagination is available only with group_by. Location uses the first retained start too. City groups use the stored name; filter by country to avoid combining names shared by different countries. Page groups use the first retained start even if playback continues after navigation. Filter by page_origin when grouping page_path to distinguish identical paths on different sites. video_title groups by the title on each view's first retained start, so a renamed video counts each view under the title it started with. user_id groups by the user ID on each view's first retained start. Use custom.<key>, such as custom.plan, to group by a custom dimension; views without the key form the null group.
     * @param int $limit Maximum rows on this page. Events and videos always support pagination; summary, quality and engagement support it only with group_by.
     * @param string $osName Exact operating-system name, such as macOS. Missing values do not match.
     * @param string $pageOrigin Exact, case-sensitive page origin captured by the player, such as https://example.com. Metrics use the first retained view start; raw events use each event context. Missing values do not match.
     * @param string $pagePath Exact, case-sensitive page path captured by the player, such as /watch/video. Filter by page_origin as well to distinguish identical paths on different sites. Metrics use the first retained view start; raw events use each event context. Missing values do not match.
     * @param string $playbackRate Playback rate from 0.01 to 16 with at most two decimals, such as 1, 1.5 or 2; 2.0 and 2 are the same rate. Metrics use the rate on the first retained view start; raw events use each event's value.
     * @param string $subtitleLanguage Exact, case-sensitive, non-blank subtitle language tag, such as fr or en-US; und for a subtitles track without a language. Metrics use the language showing on the first retained view start; raw events use each event's value. Views without subtitles at start do not match.
     * @param \DateTimeInterface $to Exclusive RFC3339 occurrence-time upper bound, with timezone. Summary/video queries apply it to the selected view_started event.
     * @param string $userID Exact integrator-supplied user ID. Selects views by their start event; event lists match each event's own value. Missing/null user IDs do not match. Reports with this filter read one stored row per view.
     * @param string $videoID Exact video ID; must not be blank. Combined with all other filters using AND.
     * @param string $videoTitle Exact, case-sensitive video title. Selects views by the title on their first retained start; event lists match each event's own value. Views without a title do not match. Reports with this filter read one stored row per view.
     * @param string $viewID Filter one playback attempt by view ID. Metrics use its first retained start.
     * @param string $viewerID Exact viewer ID. The Chunkify player SDK generates one per browser; missing/null viewer IDs do not match.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
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
        RequestOptions|array|null $requestOptions = null,
    ): Quality|QualityBreakdownPage {
        $params = Util::removeNulls(
            [
                'browserName' => $browserName,
                'city' => $city,
                'continent' => $continent,
                'country' => $country,
                'cursor' => $cursor,
                'deviceType' => $deviceType,
                'from' => $from,
                'groupBy' => $groupBy,
                'limit' => $limit,
                'osName' => $osName,
                'pageOrigin' => $pageOrigin,
                'pagePath' => $pagePath,
                'playbackRate' => $playbackRate,
                'subtitleLanguage' => $subtitleLanguage,
                'to' => $to,
                'userID' => $userID,
                'videoID' => $videoID,
                'videoTitle' => $videoTitle,
                'viewID' => $viewID,
                'viewerID' => $viewerID,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieve(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
