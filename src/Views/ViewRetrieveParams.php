<?php

declare(strict_types=1);

namespace ChunkifyAnalytics\Views;

use ChunkifyAnalytics\Core\Attributes\Optional;
use ChunkifyAnalytics\Core\Concerns\SdkModel;
use ChunkifyAnalytics\Core\Concerns\SdkParams;
use ChunkifyAnalytics\Core\Contracts\BaseModel;

/**
 * Returns start context and selected measurements, plus a paginated history of all retained events for that view ID, in ingestion order. SDK sequence and occurrence times remain in each event. Follow next_cursor with the same view ID; the summary and event pages share the initial ingestion watermark. Orphaned events without a retained start remain available through /v1/events?view_id=... .
 *
 * @see ChunkifyAnalytics\Services\ViewsService::retrieve()
 *
 * @phpstan-type ViewRetrieveParamsShape = array{
 *   cursor?: string|null, limit?: int|null
 * }
 */
final class ViewRetrieveParams implements BaseModel
{
    /** @use SdkModel<ViewRetrieveParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Use next_cursor from the previous page. Keep the same filters, sort_by and order. Video cursors from earlier versions are invalid; start a new pagination sequence after upgrading.
     */
    #[Optional]
    public ?string $cursor;

    /**
     * Maximum rows on this page. Events and videos always support pagination; summary, quality and engagement support it only with group_by.
     */
    #[Optional]
    public ?int $limit;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(?string $cursor = null, ?int $limit = null): self
    {
        $self = new self;

        null !== $cursor && $self['cursor'] = $cursor;
        null !== $limit && $self['limit'] = $limit;

        return $self;
    }

    /**
     * Use next_cursor from the previous page. Keep the same filters, sort_by and order. Video cursors from earlier versions are invalid; start a new pagination sequence after upgrading.
     */
    public function withCursor(string $cursor): self
    {
        $self = clone $this;
        $self['cursor'] = $cursor;

        return $self;
    }

    /**
     * Maximum rows on this page. Events and videos always support pagination; summary, quality and engagement support it only with group_by.
     */
    public function withLimit(int $limit): self
    {
        $self = clone $this;
        $self['limit'] = $limit;

        return $self;
    }
}
