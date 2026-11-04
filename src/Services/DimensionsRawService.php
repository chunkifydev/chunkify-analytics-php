<?php

declare(strict_types=1);

namespace ChunkifyAnalytics\Services;

use ChunkifyAnalytics\Client;
use ChunkifyAnalytics\Core\Contracts\BaseResponse;
use ChunkifyAnalytics\Core\Exceptions\APIException;
use ChunkifyAnalytics\Core\Util;
use ChunkifyAnalytics\Dimensions\DimensionListValuesParams;
use ChunkifyAnalytics\Dimensions\DimensionListValuesParams\Continent;
use ChunkifyAnalytics\Dimensions\DimensionListValuesParams\DeviceType;
use ChunkifyAnalytics\Dimensions\DimensionListValuesParams\Dimension;
use ChunkifyAnalytics\Dimensions\DimensionValues\Value;
use ChunkifyAnalytics\DimensionValuesPage;
use ChunkifyAnalytics\RequestOptions;
use ChunkifyAnalytics\ServiceContracts\DimensionsRawContract;

/**
 * Private retained-event and view-cohort queries.
 *
 * @phpstan-import-type RequestOpts from \ChunkifyAnalytics\RequestOptions
 */
final class DimensionsRawService implements DimensionsRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Values and view counts come from the first retained view starts, after applying the same cohort filters as summary. Values sort by views descending, then value ascending with null first for ties; missing context is separate from the literal unknown. Cursors bind the dimension, filters, project and ingestion watermark.
     *
     * @param Dimension|value-of<Dimension> $dimension discover values from first retained view-start context, with view counts
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
     * }|DimensionListValuesParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<DimensionValuesPage<Value>>
     *
     * @throws APIException
     */
    public function listValues(
        Dimension|string $dimension,
        array|DimensionListValuesParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = DimensionListValuesParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['v1/dimensions/%1$s', $dimension],
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
            convert: Value::class,
            page: DimensionValuesPage::class,
            security: ['secretKey' => true],
        );
    }
}
