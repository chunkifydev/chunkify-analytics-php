<?php

declare(strict_types=1);

namespace ChunkifyAnalytics\Services;

use ChunkifyAnalytics\Client;
use ChunkifyAnalytics\Core\Contracts\BaseResponse;
use ChunkifyAnalytics\Core\Exceptions\APIException;
use ChunkifyAnalytics\Core\Util;
use ChunkifyAnalytics\Engagement\Engagement;
use ChunkifyAnalytics\Engagement\EngagementBreakdownPage;
use ChunkifyAnalytics\Engagement\EngagementResponse;
use ChunkifyAnalytics\Engagement\EngagementRetrieveParams;
use ChunkifyAnalytics\Engagement\EngagementRetrieveParams\Continent;
use ChunkifyAnalytics\Engagement\EngagementRetrieveParams\DeviceType;
use ChunkifyAnalytics\Engagement\EngagementRetrieveParams\GroupBy;
use ChunkifyAnalytics\RequestOptions;
use ChunkifyAnalytics\ServiceContracts\EngagementRawContract;

/**
 * Private retained-event and view-cohort queries.
 *
 * @phpstan-import-type RequestOpts from \ChunkifyAnalytics\RequestOptions
 */
final class EngagementRawService implements EngagementRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Get average watch time per attempt and the observed reached-end rate. Reaching the end does not prove the whole video was watched. Optionally group the full filtered view-start cohort with group_by=browser_name, os_name, device_type, continent, country or city. Without group_by the totals response is unchanged. With group_by, return paginated groups sorted by views descending. Equal view counts sort by value ascending, null first. Context comes from the first retained start; missing, null and nonstring values form a null group. Keep group_by and filters unchanged with each cursor. Unique viewers must not be summed across groups. Includes furthest-progress milestones and measured watch-time distribution. Progress can include seeking and is not retention.
     *
     * @param array{
     *   browserName?: string,
     *   city?: string,
     *   continent?: Continent|value-of<Continent>,
     *   country?: string,
     *   cursor?: string,
     *   deviceType?: DeviceType|value-of<DeviceType>,
     *   from?: \DateTimeInterface,
     *   groupBy?: string|GroupBy|value-of<GroupBy>,
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
     * }|EngagementRetrieveParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Engagement|EngagementBreakdownPage>
     *
     * @throws APIException
     */
    public function retrieve(
        array|EngagementRetrieveParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = EngagementRetrieveParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'v1/engagement',
            query: Util::array_transform_keys(
                $parsed,
                [
                    'browserName' => 'browser_name',
                    'deviceType' => 'device_type',
                    'groupBy' => 'group_by',
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
            convert: EngagementResponse::class,
            security: ['secretKey' => true],
        );
    }
}
