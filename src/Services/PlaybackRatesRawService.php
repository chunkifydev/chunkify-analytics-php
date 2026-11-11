<?php

declare(strict_types=1);

namespace ChunkifyAnalytics\Services;

use ChunkifyAnalytics\Client;
use ChunkifyAnalytics\Core\Contracts\BaseResponse;
use ChunkifyAnalytics\Core\Exceptions\APIException;
use ChunkifyAnalytics\Core\Util;
use ChunkifyAnalytics\PlaybackRates\PlaybackRateReport;
use ChunkifyAnalytics\PlaybackRates\PlaybackRateRetrieveParams;
use ChunkifyAnalytics\PlaybackRates\PlaybackRateRetrieveParams\Continent;
use ChunkifyAnalytics\PlaybackRates\PlaybackRateRetrieveParams\DeviceType;
use ChunkifyAnalytics\RequestOptions;
use ChunkifyAnalytics\ServiceContracts\PlaybackRatesRawContract;

/**
 * Private retained-event and view-cohort queries.
 *
 * @phpstan-import-type RequestOpts from \ChunkifyAnalytics\RequestOptions
 */
final class PlaybackRatesRawService implements PlaybackRatesRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Summarize watch time per playback rate. Expand each view's cumulative playback_rate_playing_time array once; rates are rounded to two decimals. Playing time is wall-clock time, so a minute at 2 covers about two minutes of media. Use only the selected final event, or latest snapshot when no final exists, for the filtered view-start cohort. Missing or empty measurements contribute no time; older SDKs send none. Rank by playing time descending, then value ascending with null first; limit bounds returned rows only, while totals cover every matching row. Views can contribute to several rows and must not be summed. No cursor, group_by, sort_by or order. Export resource=playback_rates includes all matching rows.
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
     *   playbackRate?: string,
     *   subtitleLanguage?: string,
     *   to?: \DateTimeInterface,
     *   userID?: string,
     *   videoID?: string,
     *   videoTitle?: string,
     *   viewID?: string,
     *   viewerID?: string,
     * }|PlaybackRateRetrieveParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<PlaybackRateReport>
     *
     * @throws APIException
     */
    public function retrieve(
        array|PlaybackRateRetrieveParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = PlaybackRateRetrieveParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'v1/playback-rates',
            query: Util::array_transform_keys(
                $parsed,
                [
                    'browserName' => 'browser_name',
                    'deviceType' => 'device_type',
                    'osName' => 'os_name',
                    'pageOrigin' => 'page_origin',
                    'pagePath' => 'page_path',
                    'playbackRate' => 'playback_rate',
                    'subtitleLanguage' => 'subtitle_language',
                    'userID' => 'user_id',
                    'videoID' => 'video_id',
                    'videoTitle' => 'video_title',
                    'viewID' => 'view_id',
                    'viewerID' => 'viewer_id',
                ],
            ),
            options: $options,
            convert: PlaybackRateReport::class,
            security: ['secretKey' => true],
        );
    }
}
