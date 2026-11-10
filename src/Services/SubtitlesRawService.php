<?php

declare(strict_types=1);

namespace ChunkifyAnalytics\Services;

use ChunkifyAnalytics\Client;
use ChunkifyAnalytics\Core\Contracts\BaseResponse;
use ChunkifyAnalytics\Core\Exceptions\APIException;
use ChunkifyAnalytics\Core\Util;
use ChunkifyAnalytics\RequestOptions;
use ChunkifyAnalytics\ServiceContracts\SubtitlesRawContract;
use ChunkifyAnalytics\Subtitles\SubtitleReport;
use ChunkifyAnalytics\Subtitles\SubtitleRetrieveParams;
use ChunkifyAnalytics\Subtitles\SubtitleRetrieveParams\Continent;
use ChunkifyAnalytics\Subtitles\SubtitleRetrieveParams\DeviceType;

/**
 * Private retained-event and view-cohort queries.
 *
 * @phpstan-import-type RequestOpts from \ChunkifyAnalytics\RequestOptions
 */
final class SubtitlesRawService implements SubtitlesRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Summarize watch time per subtitle language. Expand each view's cumulative subtitle_playing_time array once; a null language is time with subtitles off. Use only the selected final event, or latest snapshot when no final exists, for the filtered view-start cohort. Missing or empty measurements contribute no time; older SDKs send none. Rank by playing time descending, then value ascending with null first; limit bounds returned rows only, while totals cover every matching row. Views can contribute to several rows and must not be summed. No cursor, group_by, sort_by or order. Export resource=subtitles includes all matching rows.
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
     * }|SubtitleRetrieveParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<SubtitleReport>
     *
     * @throws APIException
     */
    public function retrieve(
        array|SubtitleRetrieveParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = SubtitleRetrieveParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'v1/subtitles',
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
            convert: SubtitleReport::class,
            security: ['secretKey' => true],
        );
    }
}
