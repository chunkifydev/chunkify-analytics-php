<?php

declare(strict_types=1);

namespace ChunkifyAnalytics\ServiceContracts;

use ChunkifyAnalytics\Core\Contracts\BaseResponse;
use ChunkifyAnalytics\Core\Exceptions\APIException;
use ChunkifyAnalytics\Exports\Export;
use ChunkifyAnalytics\Exports\ExportColumns;
use ChunkifyAnalytics\Exports\ExportCreateParams;
use ChunkifyAnalytics\Exports\ExportListColumnsParams;
use ChunkifyAnalytics\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \ChunkifyAnalytics\RequestOptions
 */
interface ExportsRawContract
{
    /**
     * @api
     *
     * @param array<string,mixed>|ExportCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Export>
     *
     * @throws APIException
     */
    public function create(
        array|ExportCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $token Unguessable scoped download credential. No project key is needed.
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<string>
     *
     * @throws APIException
     */
    public function download(
        string $token,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|ExportListColumnsParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<ExportColumns>
     *
     * @throws APIException
     */
    public function listColumns(
        array|ExportListColumnsParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}
