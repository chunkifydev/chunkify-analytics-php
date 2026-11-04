<?php

declare(strict_types=1);

namespace ChunkifyAnalytics\Exports;

use ChunkifyAnalytics\Core\Attributes\Required;
use ChunkifyAnalytics\Core\Concerns\SdkModel;
use ChunkifyAnalytics\Core\Contracts\BaseModel;

/**
 * @phpstan-type ExportColumnsShape = array{columns: list<string>}
 */
final class ExportColumns implements BaseModel
{
    /** @use SdkModel<ExportColumnsShape> */
    use SdkModel;

    /**
     * Available CSV column names in default output order.
     *
     * @var list<string> $columns
     */
    #[Required(list: 'string')]
    public array $columns;

    /**
     * `new ExportColumns()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ExportColumns::with(columns: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ExportColumns)->withColumns(...)
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
     * @param list<string> $columns
     */
    public static function with(array $columns): self
    {
        $self = new self;

        $self['columns'] = $columns;

        return $self;
    }

    /**
     * Available CSV column names in default output order.
     *
     * @param list<string> $columns
     */
    public function withColumns(array $columns): self
    {
        $self = clone $this;
        $self['columns'] = $columns;

        return $self;
    }
}
