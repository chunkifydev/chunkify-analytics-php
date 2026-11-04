<?php

declare(strict_types=1);

namespace ChunkifyAnalytics\Services;

use ChunkifyAnalytics\Client;
use ChunkifyAnalytics\Core\Contracts\BaseResponse;
use ChunkifyAnalytics\Core\Exceptions\APIException;
use ChunkifyAnalytics\Core\Util;
use ChunkifyAnalytics\Renditions\RenditionReport;
use ChunkifyAnalytics\Renditions\RenditionRetrieveParams;
use ChunkifyAnalytics\Renditions\RenditionRetrieveParams\Continent;
use ChunkifyAnalytics\Renditions\RenditionRetrieveParams\DeviceType;
use ChunkifyAnalytics\RequestOptions;
use ChunkifyAnalytics\ServiceContracts\RenditionsRawContract;

/**
 * Private retained-event and view-cohort queries.
 *
 * @phpstan-import-type RequestOpts from \ChunkifyAnalytics\RequestOptions
 */
final class RenditionsRawService implements RenditionsRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Summarize rendition measurements for the filtered view-start cohort. Use only the selected final event, or latest snapshot when no final exists. Expand its cumulative rendition_playing_time array once per view. Missing or empty measurements contribute no rendition time. Rank by playing time descending; limit bounds returned rows only, while totals and average cover every matching rendition. Average bitrate is sum(bitrate_bps * playing_time_ms) divided by playing time with a known bitrate. Dimensions, codec, bitrate and frame rate together identify a rendition. Views can contribute to several renditions and must not be summed. No cursor, group_by, sort_by or order. Export resource=renditions includes all matching rows.
     *
     * @param array{
     *   browserName?: string,
     *   city?: string,
     *   continent?: Continent|value-of<Continent>,
     *   country?: string,
     *   deviceType?: DeviceType|value-of<DeviceType>,
     *   from?: \DateTimeInterface,
     *   limit?: int,
     *   osName?: string,
     *   pageOrigin?: string,
     *   pagePath?: string,
     *   to?: \DateTimeInterface,
     *   videoID?: string,
     *   viewID?: string,
     *   viewerID?: string,
     * }|RenditionRetrieveParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<RenditionReport>
     *
     * @throws APIException
     */
    public function retrieve(
        array|RenditionRetrieveParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = RenditionRetrieveParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'v1/renditions',
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
            convert: RenditionReport::class,
            security: ['secretKey' => true],
        );
    }
}
