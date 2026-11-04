<?php

declare(strict_types=1);

namespace ChunkifyAnalytics\Services;

use ChunkifyAnalytics\Client;
use ChunkifyAnalytics\Core\Contracts\BaseResponse;
use ChunkifyAnalytics\Core\Exceptions\APIException;
use ChunkifyAnalytics\Core\Util;
use ChunkifyAnalytics\Quality\Quality;
use ChunkifyAnalytics\Quality\QualityBreakdownPage;
use ChunkifyAnalytics\Quality\QualityResponse;
use ChunkifyAnalytics\Quality\QualityRetrieveParams;
use ChunkifyAnalytics\Quality\QualityRetrieveParams\Continent;
use ChunkifyAnalytics\Quality\QualityRetrieveParams\DeviceType;
use ChunkifyAnalytics\Quality\QualityRetrieveParams\GroupBy;
use ChunkifyAnalytics\RequestOptions;
use ChunkifyAnalytics\ServiceContracts\QualityRawContract;

/**
 * Private retained-event and view-cohort queries.
 *
 * @phpstan-import-type RequestOpts from \ChunkifyAnalytics\RequestOptions
 */
final class QualityRawService implements QualityRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Get startup time, buffering, and observed fatal errors for matching playback attempts. Null means unavailable. Optionally group the full filtered view-start cohort with group_by=browser_name, os_name, device_type, continent, country or city. Without group_by the totals response is unchanged. With group_by, return paginated groups sorted by views descending. Equal view counts sort by value ascending, null first. Context comes from the first retained start; missing, null and nonstring values form a null group. Keep group_by and filters unchanged with each cursor. Unique viewers must not be summed across groups. Includes mutually exclusive startup outcomes; unknown outcomes remain explicit.
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
     * }|QualityRetrieveParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Quality|QualityBreakdownPage>
     *
     * @throws APIException
     */
    public function retrieve(
        array|QualityRetrieveParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = QualityRetrieveParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'v1/quality',
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
            convert: QualityResponse::class,
            security: ['secretKey' => true],
        );
    }
}
