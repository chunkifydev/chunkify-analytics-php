<?php

declare(strict_types=1);

namespace ChunkifyAnalytics\Services;

use ChunkifyAnalytics\Client;
use ChunkifyAnalytics\Core\Contracts\BaseResponse;
use ChunkifyAnalytics\Core\Exceptions\APIException;
use ChunkifyAnalytics\Core\Util;
use ChunkifyAnalytics\Errors\ErrorGroup;
use ChunkifyAnalytics\Errors\ErrorListParams;
use ChunkifyAnalytics\Errors\ErrorListParams\Continent;
use ChunkifyAnalytics\Errors\ErrorListParams\DeviceType;
use ChunkifyAnalytics\ErrorsPage;
use ChunkifyAnalytics\RequestOptions;
use ChunkifyAnalytics\ServiceContracts\ErrorsRawContract;

/**
 * Private retained-event and view-cohort queries.
 *
 * @phpstan-import-type RequestOpts from \ChunkifyAnalytics\RequestOptions
 */
final class ErrorsRawService implements ErrorsRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Filters select first retained starts. Error events from the selected view identity contribute even after to. Group by exact JSON error_code and fatal status, distinguishing numeric codes from text and missing from false. Sort by affected_views descending, then canonical JSON code and fatal status ascending for ties. error_events counts distinct event IDs per group, affected_views counts distinct view IDs. Groups are not additive across codes. Cursors exclude later arrivals.
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
     *   osName?: string,
     *   pageOrigin?: string,
     *   pagePath?: string,
     *   to?: \DateTimeInterface,
     *   videoID?: string,
     *   viewID?: string,
     *   viewerID?: string,
     * }|ErrorListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<ErrorsPage<ErrorGroup>>
     *
     * @throws APIException
     */
    public function list(
        array|ErrorListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = ErrorListParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'v1/errors',
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
            convert: ErrorGroup::class,
            page: ErrorsPage::class,
            security: ['secretKey' => true],
        );
    }
}
