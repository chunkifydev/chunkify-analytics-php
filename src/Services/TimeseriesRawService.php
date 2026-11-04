<?php

declare(strict_types=1);

namespace ChunkifyAnalytics\Services;

use ChunkifyAnalytics\Client;
use ChunkifyAnalytics\Core\Contracts\BaseResponse;
use ChunkifyAnalytics\Core\Exceptions\APIException;
use ChunkifyAnalytics\Core\Util;
use ChunkifyAnalytics\RequestOptions;
use ChunkifyAnalytics\ServiceContracts\TimeseriesRawContract;
use ChunkifyAnalytics\Timeseries\EngagementTimeseries;
use ChunkifyAnalytics\Timeseries\QualityTimeseries;
use ChunkifyAnalytics\Timeseries\Timeseries;
use ChunkifyAnalytics\Timeseries\TimeseriesResponse;
use ChunkifyAnalytics\Timeseries\TimeseryRetrieveParams;
use ChunkifyAnalytics\Timeseries\TimeseryRetrieveParams\Continent;
use ChunkifyAnalytics\Timeseries\TimeseryRetrieveParams\DeviceType;
use ChunkifyAnalytics\Timeseries\TimeseryRetrieveParams\Interval;
use ChunkifyAnalytics\Timeseries\TimeseryRetrieveParams\Kind;

/**
 * Private retained-event and view-cohort queries.
 *
 * @phpstan-import-type RequestOpts from \ChunkifyAnalytics\RequestOptions
 */
final class TimeseriesRawService implements TimeseriesRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Supply from, to and interval=hour|day. kind defaults to summary and also accepts quality or engagement. Every bucket selects first retained starts in its UTC interval and includes each selected view's whole retained measurement and errors, even after to. Empty buckets have zero counts and null unavailable measurements or ratios. At most 1000 buckets. Unique viewer counts are not additive.
     *
     * @param array{
     *   from: \DateTimeInterface,
     *   interval: Interval|value-of<Interval>,
     *   to: \DateTimeInterface,
     *   browserName?: string,
     *   city?: string,
     *   continent?: Continent|value-of<Continent>,
     *   country?: string,
     *   deviceType?: DeviceType|value-of<DeviceType>,
     *   kind?: Kind|value-of<Kind>,
     *   osName?: string,
     *   pageOrigin?: string,
     *   pagePath?: string,
     *   videoID?: string,
     *   viewID?: string,
     *   viewerID?: string,
     * }|TimeseryRetrieveParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Timeseries|QualityTimeseries|EngagementTimeseries>
     *
     * @throws APIException
     */
    public function retrieve(
        array|TimeseryRetrieveParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = TimeseryRetrieveParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'v1/timeseries',
            query: Util::array_transform_keys(
                $parsed,
                [
                    'browserName' => 'browser_name',
                    'deviceType' => 'device_type',
                    'osName' => 'os_name',
                    'pageOrigin' => 'page_origin',
                    'pagePath' => 'page_path',
                    'videoID' => 'video_id',
                    'viewID' => 'view_id',
                    'viewerID' => 'viewer_id',
                ],
            ),
            options: $options,
            convert: TimeseriesResponse::class,
            security: ['secretKey' => true],
        );
    }
}
