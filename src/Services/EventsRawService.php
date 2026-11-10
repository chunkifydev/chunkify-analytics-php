<?php

declare(strict_types=1);

namespace ChunkifyAnalytics\Services;

use ChunkifyAnalytics\Client;
use ChunkifyAnalytics\Core\Contracts\BaseResponse;
use ChunkifyAnalytics\Core\Exceptions\APIException;
use ChunkifyAnalytics\Core\Util;
use ChunkifyAnalytics\Events\EventIngestParams;
use ChunkifyAnalytics\Events\EventIngestParams\ContentEncoding;
use ChunkifyAnalytics\Events\EventIngestResponse;
use ChunkifyAnalytics\Events\EventListParams;
use ChunkifyAnalytics\Events\EventListParams\Continent;
use ChunkifyAnalytics\Events\EventListParams\DeviceType;
use ChunkifyAnalytics\Events\EventListParams\EventName;
use ChunkifyAnalytics\Events\EventListParams\Order;
use ChunkifyAnalytics\Events\NativeCreated;
use ChunkifyAnalytics\Events\NativeDuplicate;
use ChunkifyAnalytics\Events\StoredEvent;
use ChunkifyAnalytics\EventsPage;
use ChunkifyAnalytics\RequestOptions;
use ChunkifyAnalytics\ServiceContracts\EventsRawContract;

/**
 * @phpstan-import-type AnalyticsEventShape from \ChunkifyAnalytics\Events\AnalyticsEvent
 * @phpstan-import-type RequestOpts from \ChunkifyAnalytics\RequestOptions
 */
final class EventsRawService implements EventsRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * List project events with filters and pagination. Use order=desc for the newest events.
     *
     * @param array{
     *   browserName?: string,
     *   city?: string,
     *   continent?: Continent|value-of<Continent>,
     *   country?: string,
     *   cursor?: string,
     *   deviceType?: DeviceType|value-of<DeviceType>,
     *   eventName?: value-of<EventName>,
     *   from?: \DateTimeInterface,
     *   limit?: int,
     *   order?: Order|value-of<Order>,
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
     * }|EventListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<EventsPage<StoredEvent>>
     *
     * @throws APIException
     */
    public function list(
        array|EventListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = EventListParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'v1/events',
            query: Util::array_transform_keys(
                $parsed,
                [
                    'browserName' => 'browser_name',
                    'deviceType' => 'device_type',
                    'eventName' => 'event_name',
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
            convert: StoredEvent::class,
            page: EventsPage::class,
            security: ['secretKey' => true],
        );
    }

    /**
     * @api
     *
     * Send one playback event using a public key. Success confirms storage completed.
     *
     * Configure the client with a public ingestion key for this method. The SDK
     * sends the event you supply; it does not collect playback events automatically.
     * For automatic browser player tracking, use `@chunkify/player-analytics`.
     *
     * @param array{
     *   event: AnalyticsEventShape,
     *   contentEncoding?: ContentEncoding|value-of<ContentEncoding>,
     *   origin?: string,
     * }|EventIngestParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<NativeCreated|NativeDuplicate>
     *
     * @throws APIException
     */
    public function ingest(
        array|EventIngestParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = EventIngestParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'v1/events',
            headers: Util::array_transform_keys(
                array_diff_key($parsed, array_flip(['event'])),
                ['contentEncoding' => 'Content-Encoding', 'origin' => 'Origin'],
            ),
            body: (object) $parsed['event'],
            options: $options,
            convert: EventIngestResponse::class,
            security: ['publicKey' => true],
        );
    }
}
