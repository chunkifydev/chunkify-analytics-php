<?php

declare(strict_types=1);

namespace ChunkifyAnalytics\Exports;

use ChunkifyAnalytics\Core\Attributes\Optional;
use ChunkifyAnalytics\Core\Attributes\Required;
use ChunkifyAnalytics\Core\Concerns\SdkModel;
use ChunkifyAnalytics\Core\Contracts\BaseModel;
use ChunkifyAnalytics\Exports\ExportRequest\Resource;

/**
 * @phpstan-import-type ExportQueryShape from \ChunkifyAnalytics\Exports\ExportQuery
 *
 * @phpstan-type ExportRequestShape = array{
 *   resource: Resource|value-of<Resource>,
 *   columns?: list<string>|null,
 *   query?: null|ExportQuery|ExportQueryShape,
 * }
 */
final class ExportRequest implements BaseModel
{
    /** @use SdkModel<ExportRequestShape> */
    use SdkModel;

    /** @var value-of<resource> $resource */
    #[Required(enum: Resource::class)]
    public string $resource;

    /**
     * CSV column names in output order. Omit for all columns. Get the available names from GET /v1/exports using the same resource, kind and group_by. Unknown names, duplicates and empty selections are rejected.
     *
     * @var list<string>|null $columns
     */
    #[Optional(list: 'string')]
    public ?array $columns;

    #[Optional]
    public ?ExportQuery $query;

    /**
     * `new ExportRequest()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ExportRequest::with(resource: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ExportRequest)->withResource(...)
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
     * @param list<string>|null $columns
     * @param ExportQuery|ExportQueryShape|null $query
     */
    public static function with(
        Resource|string $resource,
        ?array $columns = null,
        ExportQuery|array|null $query = null,
    ): self {
        $self = new self;

        $self['resource'] = $resource;

        null !== $columns && $self['columns'] = $columns;
        null !== $query && $self['query'] = $query;

        return $self;
    }

    /**
     * @param resource|value-of<resource> $resource
     */
    public function withResource(Resource|string $resource): self
    {
        $self = clone $this;
        $self['resource'] = $resource;

        return $self;
    }

    /**
     * CSV column names in output order. Omit for all columns. Get the available names from GET /v1/exports using the same resource, kind and group_by. Unknown names, duplicates and empty selections are rejected.
     *
     * @param list<string> $columns
     */
    public function withColumns(array $columns): self
    {
        $self = clone $this;
        $self['columns'] = $columns;

        return $self;
    }

    /**
     * @param ExportQuery|ExportQueryShape $query
     */
    public function withQuery(ExportQuery|array $query): self
    {
        $self = clone $this;
        $self['query'] = $query;

        return $self;
    }
}
