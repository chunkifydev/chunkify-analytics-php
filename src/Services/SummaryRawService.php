<?php

declare(strict_types=1);

namespace ChunkifyAnalytics\Services;

use ChunkifyAnalytics\Client;
use ChunkifyAnalytics\Core\Contracts\BaseResponse;
use ChunkifyAnalytics\Core\Exceptions\APIException;
use ChunkifyAnalytics\Core\Util;
use ChunkifyAnalytics\RequestOptions;
use ChunkifyAnalytics\ServiceContracts\SummaryRawContract;
use ChunkifyAnalytics\Summary\Metrics;
use ChunkifyAnalytics\Summary\MetricsBreakdownPage;
use ChunkifyAnalytics\Summary\MetricsResponse;
use ChunkifyAnalytics\Summary\SummaryRetrieveParams;
use ChunkifyAnalytics\Summary\SummaryRetrieveParams\Continent;
use ChunkifyAnalytics\Summary\SummaryRetrieveParams\DeviceType;
use ChunkifyAnalytics\Summary\SummaryRetrieveParams\GroupBy;

/**
 * Private retained-event and view-cohort queries.
 *
 * @phpstan-import-type RequestOpts from \ChunkifyAnalytics\RequestOptions
 */
final class SummaryRawService implements SummaryRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Get views, unique viewer IDs, and playing time for matching playback attempts. Optionally group the full filtered view-start cohort with group_by=browser_name, os_name, device_type, continent, country or city. Without group_by the totals response is unchanged. With group_by, return paginated groups sorted by views descending. Equal view counts sort by value ascending, null first. Context comes from the first retained start; missing, null and nonstring values form a null group. Keep group_by and filters unchanged with each cursor. Unique viewers must not be summed across groups.
     *
     * @param array{
     *   browserName?: string,
     *   city?: string,
     *   continent?: Continent|value-of<Continent>,
     *   country?: string,
     *   cursor?: string,
     *   deviceType?: DeviceType|value-of<DeviceType>,
     *   from?: \DateTimeInterface,
     *   groupBy?: value-of<GroupBy>,
     *   limit?: int,
     *   osName?: string,
     *   pageOrigin?: string,
     *   pagePath?: string,
     *   to?: \DateTimeInterface,
     *   videoID?: string,
     *   viewID?: string,
     *   viewerID?: string,
     * }|SummaryRetrieveParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Metrics|MetricsBreakdownPage>
     *
     * @throws APIException
     */
    public function retrieve(
        array|SummaryRetrieveParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = SummaryRetrieveParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'v1/summary',
            query: Util::array_transform_keys(
                $parsed,
                [
                    'browserName' => 'browser_name',
                    'deviceType' => 'device_type',
                    'groupBy' => 'group_by',
                    'osName' => 'os_name',
                    'pageOrigin' => 'page_origin',
                    'pagePath' => 'page_path',
                    'videoID' => 'video_id',
                    'viewID' => 'view_id',
                    'viewerID' => 'viewer_id',
                ],
            ),
            options: $options,
            convert: MetricsResponse::class,
            security: ['secretKey' => true],
        );
    }
}
