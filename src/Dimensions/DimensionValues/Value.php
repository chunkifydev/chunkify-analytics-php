<?php

declare(strict_types=1);

namespace ChunkifyAnalytics\Dimensions\DimensionValues;

use ChunkifyAnalytics\Core\Attributes\Required;
use ChunkifyAnalytics\Core\Concerns\SdkModel;
use ChunkifyAnalytics\Core\Contracts\BaseModel;

/**
 * @phpstan-type ValueShape = array{value: string|null, views: int}
 */
final class Value implements BaseModel
{
    /** @use SdkModel<ValueShape> */
    use SdkModel;

    #[Required]
    public ?string $value;

    #[Required]
    public int $views;

    /**
     * `new Value()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Value::with(value: ..., views: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Value)->withValue(...)->withViews(...)
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
     */
    public static function with(?string $value, int $views): self
    {
        $self = new self;

        $self['value'] = $value;
        $self['views'] = $views;

        return $self;
    }

    public function withValue(?string $value): self
    {
        $self = clone $this;
        $self['value'] = $value;

        return $self;
    }

    public function withViews(int $views): self
    {
        $self = clone $this;
        $self['views'] = $views;

        return $self;
    }
}
