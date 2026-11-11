<?php

declare(strict_types=1);

namespace ChunkifyAnalytics\ServiceContracts;

use ChunkifyAnalytics\Core\Contracts\BaseResponse;
use ChunkifyAnalytics\Core\Exceptions\APIException;
use ChunkifyAnalytics\RequestOptions;
use ChunkifyAnalytics\Subtitles\SubtitleReport;
use ChunkifyAnalytics\Subtitles\SubtitleRetrieveParams;

/**
 * @phpstan-import-type RequestOpts from \ChunkifyAnalytics\RequestOptions
 */
interface SubtitlesRawContract
{
    /**
     * @api
     *
     * @param array<string,mixed>|SubtitleRetrieveParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<SubtitleReport>
     *
     * @throws APIException
     */
    public function retrieve(
        array|SubtitleRetrieveParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}
