<?php

declare(strict_types=1);

namespace ChunkifyAnalytics\Dimensions;

use ChunkifyAnalytics\Core\Attributes\Required;
use ChunkifyAnalytics\Core\Concerns\SdkModel;
use ChunkifyAnalytics\Core\Contracts\BaseModel;
use ChunkifyAnalytics\Dimensions\DimensionValues\Dimension;
use ChunkifyAnalytics\Dimensions\DimensionValues\Value;

/**
 * @phpstan-import-type ValueShape from \ChunkifyAnalytics\Dimensions\DimensionValues\Value
 *
 * @phpstan-type DimensionValuesShape = array{
 *   dimension: Dimension|value-of<Dimension>,
 *   nextCursor: string|null,
 *   values: list<Value|ValueShape>,
 * }
 */
final class DimensionValues implements BaseModel
{
    /** @use SdkModel<DimensionValuesShape> */
    use SdkModel;

    /** @var value-of<Dimension> $dimension */
    #[Required(enum: Dimension::class)]
    public string $dimension;

    #[Required('next_cursor')]
    public ?string $nextCursor;

    /** @var list<Value> $values */
    #[Required(list: Value::class)]
    public array $values;

    /**
     * `new DimensionValues()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * DimensionValues::with(dimension: ..., nextCursor: ..., values: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new DimensionValues)->withDimension(...)->withNextCursor(...)->withValues(...)
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
     * @param Dimension|value-of<Dimension> $dimension
     * @param list<Value|ValueShape> $values
     */
    public static function with(
        Dimension|string $dimension,
        ?string $nextCursor,
        array $values
    ): self {
        $self = new self;

        $self['dimension'] = $dimension;
        $self['nextCursor'] = $nextCursor;
        $self['values'] = $values;

        return $self;
    }

    /**
     * @param Dimension|value-of<Dimension> $dimension
     */
    public function withDimension(Dimension|string $dimension): self
    {
        $self = clone $this;
        $self['dimension'] = $dimension;

        return $self;
    }

    public function withNextCursor(?string $nextCursor): self
    {
        $self = clone $this;
        $self['nextCursor'] = $nextCursor;

        return $self;
    }

    /**
     * @param list<Value|ValueShape> $values
     */
    public function withValues(array $values): self
    {
        $self = clone $this;
        $self['values'] = $values;

        return $self;
    }
}
