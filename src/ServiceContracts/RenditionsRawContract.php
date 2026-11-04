<?php

declare(strict_types=1);

namespace ChunkifyAnalytics\ServiceContracts;

use ChunkifyAnalytics\Core\Contracts\BaseResponse;
use ChunkifyAnalytics\Core\Exceptions\APIException;
use ChunkifyAnalytics\Renditions\RenditionReport;
use ChunkifyAnalytics\Renditions\RenditionRetrieveParams;
use ChunkifyAnalytics\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \ChunkifyAnalytics\RequestOptions
 */
interface RenditionsRawContract
{
    /**
     * @api
     *
     * @param array<string,mixed>|RenditionRetrieveParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<RenditionReport>
     *
     * @throws APIException
     */
    public function retrieve(
        array|RenditionRetrieveParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}
