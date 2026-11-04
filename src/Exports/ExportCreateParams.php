<?php

declare(strict_types=1);

namespace ChunkifyAnalytics\Exports;

use ChunkifyAnalytics\Core\Attributes\Optional;
use ChunkifyAnalytics\Core\Attributes\Required;
use ChunkifyAnalytics\Core\Concerns\SdkModel;
use ChunkifyAnalytics\Core\Concerns\SdkParams;
use ChunkifyAnalytics\Core\Contracts\BaseModel;
use ChunkifyAnalytics\Exports\ExportCreateParams\Resource;

/**
 * Create a scoped 256-bit random download token for all matching rows. Requires a project private key; read-only keys are allowed. The link expires after 30 minutes and is invalidated by issuer-key rotation/revocation, project deletion or collector restart. No CSV is generated or retained at creation. limit/cursor are rejected. Existing query endpoints continue returning JSON. Event CSV files contain documented scalar event fields and flat context.* columns. Custom attributes, nested arrays and historical OTLP payloads are excluded. CSV cells never contain JSON objects or arrays; use GET /v1/events for original payloads.
 *
 * @see ChunkifyAnalytics\Services\ExportsService::create()
 *
 * @phpstan-import-type ExportQueryShape from \ChunkifyAnalytics\Exports\ExportQuery
 *
 * @phpstan-type ExportCreateParamsShape = array{
 *   resource: Resource|value-of<Resource>,
 *   columns?: list<string>|null,
 *   query?: null|ExportQuery|ExportQueryShape,
 * }
 */
final class ExportCreateParams implements BaseModel
{
    /** @use SdkModel<ExportCreateParamsShape> */
    use SdkModel;
    use SdkParams;

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
     * `new ExportCreateParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ExportCreateParams::with(resource: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ExportCreateParams)->withResource(...)
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
