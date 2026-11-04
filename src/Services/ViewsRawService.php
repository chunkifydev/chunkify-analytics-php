<?php

declare(strict_types=1);

namespace ChunkifyAnalytics\Services;

use ChunkifyAnalytics\Client;
use ChunkifyAnalytics\Core\Contracts\BaseResponse;
use ChunkifyAnalytics\Core\Exceptions\APIException;
use ChunkifyAnalytics\Core\Util;
use ChunkifyAnalytics\RequestOptions;
use ChunkifyAnalytics\ServiceContracts\ViewsRawContract;
use ChunkifyAnalytics\Views\View;
use ChunkifyAnalytics\Views\ViewDetail;
use ChunkifyAnalytics\Views\ViewListParams;
use ChunkifyAnalytics\Views\ViewListParams\Continent;
use ChunkifyAnalytics\Views\ViewListParams\DeviceType;
use ChunkifyAnalytics\Views\ViewListParams\Order;
use ChunkifyAnalytics\Views\ViewListParams\SortBy;
use ChunkifyAnalytics\Views\ViewRetrieveParams;
use ChunkifyAnalytics\ViewsPage;

/**
 * Private retained-event and view-cohort queries.
 *
 * @phpstan-import-type RequestOpts from \ChunkifyAnalytics\RequestOptions
 */
final class ViewsRawService implements ViewsRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Returns start context and selected measurements, plus a paginated history of all retained events for that view ID, in ingestion order. SDK sequence and occurrence times remain in each event. Follow next_cursor with the same view ID; the summary and event pages share the initial ingestion watermark. Orphaned events without a retained start remain available through /v1/events?view_id=... .
     *
     * @param string $viewID playback attempt to inspect
     * @param array{cursor?: string, limit?: int}|ViewRetrieveParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<ViewDetail>
     *
     * @throws APIException
     */
    public function retrieve(
        string $viewID,
        array|ViewRetrieveParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = ViewRetrieveParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['v1/views/%1$s', $viewID],
            query: $parsed,
            options: $options,
            convert: ViewDetail::class,
            security: ['secretKey' => true],
        );
    }

    /**
     * @api
     *
     * One row per first retained start, using the same final/latest measurement selection as metrics. Filter by identity, context, dates or has_fatal_error. Order by started_at descending by default (newest first), or ascending with order=asc. Equal start times use view_id in the same direction. Cursors bind filters, order, fatal-error selection, project and ingestion watermark. Missing end or error events are not proof of an ongoing or successful playback. Sort the entire matching cohort by sort_by before pagination, with missing values last.
     *
     * @param array{
     *   browserName?: string,
     *   city?: string,
     *   continent?: Continent|value-of<Continent>,
     *   country?: string,
     *   cursor?: string,
     *   deviceType?: DeviceType|value-of<DeviceType>,
     *   from?: \DateTimeInterface,
     *   hasFatalError?: bool,
     *   limit?: int,
     *   order?: Order|value-of<Order>,
     *   osName?: string,
     *   pageOrigin?: string,
     *   pagePath?: string,
     *   sortBy?: value-of<SortBy>,
     *   to?: \DateTimeInterface,
     *   videoID?: string,
     *   viewID?: string,
     *   viewerID?: string,
     * }|ViewListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<ViewsPage<View>>
     *
     * @throws APIException
     */
    public function list(
        array|ViewListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = ViewListParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'v1/views',
            query: Util::array_transform_keys(
                $parsed,
                [
                    'browserName' => 'browser_name',
                    'deviceType' => 'device_type',
                    'hasFatalError' => 'has_fatal_error',
                    'osName' => 'os_name',
                    'pageOrigin' => 'page_origin',
                    'pagePath' => 'page_path',
                    'sortBy' => 'sort_by',
                    'videoID' => 'video_id',
                    'viewID' => 'view_id',
                    'viewerID' => 'viewer_id',
                ],
            ),
            options: $options,
            convert: View::class,
            page: ViewsPage::class,
            security: ['secretKey' => true],
        );
    }
}
