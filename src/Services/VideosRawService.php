<?php

declare(strict_types=1);

namespace ChunkifyAnalytics\Services;

use ChunkifyAnalytics\Client;
use ChunkifyAnalytics\Core\Contracts\BaseResponse;
use ChunkifyAnalytics\Core\Exceptions\APIException;
use ChunkifyAnalytics\Core\Util;
use ChunkifyAnalytics\RequestOptions;
use ChunkifyAnalytics\ServiceContracts\VideosRawContract;
use ChunkifyAnalytics\Videos\VideoListParams;
use ChunkifyAnalytics\Videos\VideoListParams\Continent;
use ChunkifyAnalytics\Videos\VideoListParams\DeviceType;
use ChunkifyAnalytics\Videos\VideoListParams\Order;
use ChunkifyAnalytics\Videos\VideoListParams\SortBy;
use ChunkifyAnalytics\Videos\VideoMetrics;
use ChunkifyAnalytics\VideosPage;

/**
 * Private retained-event and view-cohort queries.
 *
 * @phpstan-import-type RequestOpts from \ChunkifyAnalytics\RequestOptions
 */
final class VideosRawService implements VideosRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * List per-video totals. Sort the entire filtered cohort by video_id, views, unique_viewers, total_playing_time_ms or playback_score before pagination. Defaults to video_id ascending. Missing scores come last; metric ties use video_id ascending in both directions. Unique viewer counts cannot be added across videos. Keep sort_by, order and filters unchanged with a cursor.
     *
     * @param array{
     *   browserName?: string,
     *   city?: string,
     *   continent?: Continent|value-of<Continent>,
     *   country?: string,
     *   cursor?: string,
     *   deviceType?: DeviceType|value-of<DeviceType>,
     *   from?: \DateTimeInterface,
     *   limit?: int,
     *   order?: Order|value-of<Order>,
     *   osName?: string,
     *   pageOrigin?: string,
     *   pagePath?: string,
     *   playbackRate?: string,
     *   sortBy?: SortBy|value-of<SortBy>,
     *   subtitleLanguage?: string,
     *   to?: \DateTimeInterface,
     *   userID?: string,
     *   videoID?: string,
     *   videoTitle?: string,
     *   viewID?: string,
     *   viewerID?: string,
     * }|VideoListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<VideosPage<VideoMetrics>>
     *
     * @throws APIException
     */
    public function list(
        array|VideoListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = VideoListParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'v1/videos',
            query: Util::array_transform_keys(
                $parsed,
                [
                    'browserName' => 'browser_name',
                    'deviceType' => 'device_type',
                    'osName' => 'os_name',
                    'pageOrigin' => 'page_origin',
                    'pagePath' => 'page_path',
                    'playbackRate' => 'playback_rate',
                    'sortBy' => 'sort_by',
                    'subtitleLanguage' => 'subtitle_language',
                    'userID' => 'user_id',
                    'videoID' => 'video_id',
                    'videoTitle' => 'video_title',
                    'viewID' => 'view_id',
                    'viewerID' => 'viewer_id',
                ],
            ),
            options: $options,
            convert: VideoMetrics::class,
            page: VideosPage::class,
            security: ['secretKey' => true],
        );
    }
}
