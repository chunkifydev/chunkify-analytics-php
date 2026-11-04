<?php

declare(strict_types=1);

namespace ChunkifyAnalytics\ServiceContracts;

use ChunkifyAnalytics\Core\Contracts\BaseResponse;
use ChunkifyAnalytics\Core\Exceptions\APIException;
use ChunkifyAnalytics\RequestOptions;
use ChunkifyAnalytics\Views\View;
use ChunkifyAnalytics\Views\ViewDetail;
use ChunkifyAnalytics\Views\ViewListParams;
use ChunkifyAnalytics\Views\ViewRetrieveParams;
use ChunkifyAnalytics\ViewsPage;

/**
 * @phpstan-import-type RequestOpts from \ChunkifyAnalytics\RequestOptions
 */
interface ViewsRawContract
{
    /**
     * @api
     *
     * @param string $viewID playback attempt to inspect
     * @param array<string,mixed>|ViewRetrieveParams $params
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
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|ViewListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<ViewsPage<View>>
     *
     * @throws APIException
     */
    public function list(
        array|ViewListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}
