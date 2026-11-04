<?php

declare(strict_types=1);

namespace ChunkifyAnalytics\Services;

use ChunkifyAnalytics\Client;
use ChunkifyAnalytics\Core\Exceptions\APIException;
use ChunkifyAnalytics\Core\Util;
use ChunkifyAnalytics\Engagement\Engagement;
use ChunkifyAnalytics\Engagement\EngagementBreakdownPage;
use ChunkifyAnalytics\Engagement\EngagementRetrieveParams\Continent;
use ChunkifyAnalytics\Engagement\EngagementRetrieveParams\DeviceType;
use ChunkifyAnalytics\Engagement\EngagementRetrieveParams\GroupBy;
use ChunkifyAnalytics\RequestOptions;
use ChunkifyAnalytics\ServiceContracts\EngagementContract;

/**
 * Private retained-event and view-cohort queries.
 *
 * @phpstan-import-type RequestOpts from \ChunkifyAnalytics\RequestOptions
 */
final class EngagementService implements EngagementContract
{
    /**
     * @api
     */
    public EngagementRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new EngagementRawService($client);
    }

    /**
     * @api
     *
     * Get average watch time per attempt and the observed reached-end rate. Reaching the end does not prove the whole video was watched. Optionally group the full filtered view-start cohort with group_by=browser_name, os_name, device_type, continent, country or city. Without group_by the totals response is unchanged. With group_by, return paginated groups sorted by views descending. Equal view counts sort by value ascending, null first. Context comes from the first retained start; missing, null and nonstring values form a null group. Keep group_by and filters unchanged with each cursor. Unique viewers must not be summed across groups. Includes furthest-progress milestones and measured watch-time distribution. Progress can include seeking and is not retention.
     *
     * @param string $browserName Exact browser name, such as Chrome. Missing values do not match.
     * @param string $city Exact, case-sensitive city name from the local lookup, with 1 to 256 Unicode characters. Use country alongside city to distinguish places with the same name. Missing locations do not match.
     * @param Continent|value-of<Continent> $continent Exact continent code from the local lookup. Missing locations do not match.
     * @param string $country Exact uppercase ISO 3166-1 alpha-2 country code, such as GB. Missing locations do not match.
     * @param string $cursor Use next_cursor from the previous page. Keep the same filters, sort_by and order. Video cursors from earlier versions are invalid; start a new pagination sequence after upgrading.
     * @param DeviceType|value-of<DeviceType> $deviceType Exact device class. unknown matches an explicit unknown value.
     * @param \DateTimeInterface $from Inclusive RFC3339 occurrence-time lower bound, with timezone. Summary/video queries apply it to the selected view_started event. Must be before to.
     * @param GroupBy|value-of<GroupBy> $groupBy Optional on summary, quality and engagement. Group views by this field on their first retained start. Missing, null and nonstring context forms a null group; the literal device type unknown stays separate. Groups sort by views descending, then value ascending with null first for ties. Pagination is available only with group_by. Location uses the first retained start too. City groups use the stored name; filter by country to avoid combining names shared by different countries. Page groups use the first retained start even if playback continues after navigation. Filter by page_origin when grouping page_path to distinguish identical paths on different sites.
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
        ?string $cursor = null,
        DeviceType|string|null $deviceType = null,
        ?\DateTimeInterface $from = null,
        GroupBy|string|null $groupBy = null,
        int $limit = 100,
        ?string $osName = null,
        ?string $pageOrigin = null,
        ?string $pagePath = null,
        ?\DateTimeInterface $to = null,
        ?string $videoID = null,
        ?string $viewID = null,
        ?string $viewerID = null,
        RequestOptions|array|null $requestOptions = null,
    ): Engagement|EngagementBreakdownPage {
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
