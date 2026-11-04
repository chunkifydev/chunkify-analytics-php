<?php

declare(strict_types=1);

namespace ChunkifyAnalytics\Exports;

use ChunkifyAnalytics\Core\Attributes\Optional;
use ChunkifyAnalytics\Core\Attributes\Required;
use ChunkifyAnalytics\Core\Concerns\SdkModel;
use ChunkifyAnalytics\Core\Concerns\SdkParams;
use ChunkifyAnalytics\Core\Contracts\BaseModel;
use ChunkifyAnalytics\Exports\ExportListColumnsParams\GroupBy;
use ChunkifyAnalytics\Exports\ExportListColumnsParams\Kind;
use ChunkifyAnalytics\Exports\ExportListColumnsParams\Resource;

/**
 * Discover column names before creating an export. Requires a project private key; read-only keys are allowed. kind applies only to timeseries. group_by applies to summary, quality and engagement. Date ranges and filters do not change the columns.
 *
 * @see ChunkifyAnalytics\Services\ExportsService::listColumns()
 *
 * @phpstan-type ExportListColumnsParamsShape = array{
 *   resource: Resource|value-of<Resource>,
 *   groupBy?: null|GroupBy|value-of<GroupBy>,
 *   kind?: null|Kind|value-of<Kind>,
 * }
 */
final class ExportListColumnsParams implements BaseModel
{
    /** @use SdkModel<ExportListColumnsParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Report whose CSV columns to list.
     *
     * @var value-of<resource> $resource
     */
    #[Required(enum: Resource::class)]
    public string $resource;

    /**
     * Optional on summary, quality and engagement. Group views by this field on their first retained start. Missing, null and nonstring context forms a null group; the literal device type unknown stays separate. Groups sort by views descending, then value ascending with null first for ties. Pagination is available only with group_by. Location uses the first retained start too. City groups use the stored name; filter by country to avoid combining names shared by different countries. Page groups use the first retained start even if playback continues after navigation. Filter by page_origin when grouping page_path to distinguish identical paths on different sites.
     *
     * @var value-of<GroupBy>|null $groupBy
     */
    #[Optional(enum: GroupBy::class)]
    public ?string $groupBy;

    /**
     * Metric set for every time bucket. Uses the same calculations and sample counts as the corresponding totals route.
     *
     * @var value-of<Kind>|null $kind
     */
    #[Optional(enum: Kind::class)]
    public ?string $kind;

    /**
     * `new ExportListColumnsParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ExportListColumnsParams::with(resource: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ExportListColumnsParams)->withResource(...)
     * ```
     */
    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param resource|value-of<resource> $resource
     * @param GroupBy|value-of<GroupBy>|null $groupBy
     * @param Kind|value-of<Kind>|null $kind
     */
    public static function with(
        Resource|string $resource,
        GroupBy|string|null $groupBy = null,
        Kind|string|null $kind = null,
    ): self {
        $self = new self;

        $self['resource'] = $resource;

        null !== $groupBy && $self['groupBy'] = $groupBy;
        null !== $kind && $self['kind'] = $kind;

        return $self;
    }

    /**
     * Report whose CSV columns to list.
     *
     * @param resource|value-of<resource> $resource
     */
    public function withResource(Resource|string $resource): self
    {
        $self = clone $this;
        $self['resource'] = $resource;

        return $self;
    }

    /**
     * Optional on summary, quality and engagement. Group views by this field on their first retained start. Missing, null and nonstring context forms a null group; the literal device type unknown stays separate. Groups sort by views descending, then value ascending with null first for ties. Pagination is available only with group_by. Location uses the first retained start too. City groups use the stored name; filter by country to avoid combining names shared by different countries. Page groups use the first retained start even if playback continues after navigation. Filter by page_origin when grouping page_path to distinguish identical paths on different sites.
     *
     * @param GroupBy|value-of<GroupBy> $groupBy
     */
    public function withGroupBy(GroupBy|string $groupBy): self
    {
        $self = clone $this;
        $self['groupBy'] = $groupBy;

        return $self;
    }

    /**
     * Metric set for every time bucket. Uses the same calculations and sample counts as the corresponding totals route.
     *
     * @param Kind|value-of<Kind> $kind
     */
    public function withKind(Kind|string $kind): self
    {
        $self = clone $this;
        $self['kind'] = $kind;

        return $self;
    }
}
