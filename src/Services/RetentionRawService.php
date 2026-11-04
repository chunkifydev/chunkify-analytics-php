<?php

declare(strict_types=1);

namespace ChunkifyAnalytics\Services;

use ChunkifyAnalytics\Client;
use ChunkifyAnalytics\Core\Contracts\BaseResponse;
use ChunkifyAnalytics\Core\Exceptions\APIException;
use ChunkifyAnalytics\Core\Util;
use ChunkifyAnalytics\RequestOptions;
use ChunkifyAnalytics\Retention\RetentionReport;
use ChunkifyAnalytics\Retention\RetentionRetrieveParams;
use ChunkifyAnalytics\Retention\RetentionRetrieveParams\Continent;
use ChunkifyAnalytics\Retention\RetentionRetrieveParams\DeviceType;
use ChunkifyAnalytics\ServiceContracts\RetentionRawContract;

/**
 * Private retained-event and view-cohort queries.
 *
 * @phpstan-import-type RequestOpts from \ChunkifyAnalytics\RequestOptions
 */
final class RetentionRawService implements RetentionRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Count views along the video using recorded played ranges. Requires video_id. Uses the final measurement, or the latest snapshot without an end event, for each retained start matching the date and audience filters. Each attempt counts once in each section it overlapped, including replays. Skipped sections do not count. Older events without played ranges and attempts without a finite positive duration are excluded from sample_views. Returns at most 200 consecutive buckets, including zero counts, at a width of at least one second. This is media position, not wall-clock time.
     *
     * @param array{
     *   videoID: string,
     *   browserName?: string,
     *   city?: string,
     *   continent?: Continent|value-of<Continent>,
     *   country?: string,
     *   deviceType?: DeviceType|value-of<DeviceType>,
     *   from?: \DateTimeInterface,
     *   osName?: string,
     *   pageOrigin?: string,
     *   pagePath?: string,
     *   to?: \DateTimeInterface,
     *   viewID?: string,
     *   viewerID?: string,
     * }|RetentionRetrieveParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<RetentionReport>
     *
     * @throws APIException
     */
    public function retrieve(
        array|RetentionRetrieveParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = RetentionRetrieveParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'v1/retention',
            query: Util::array_transform_keys(
                $parsed,
                [
                    'videoID' => 'video_id',
                    'browserName' => 'browser_name',
                    'deviceType' => 'device_type',
                    'osName' => 'os_name',
                    'pageOrigin' => 'page_origin',
                    'pagePath' => 'page_path',
                    'viewID' => 'view_id',
                    'viewerID' => 'viewer_id',
                ],
            ),
            options: $options,
            convert: RetentionReport::class,
            security: ['secretKey' => true],
        );
    }
}
