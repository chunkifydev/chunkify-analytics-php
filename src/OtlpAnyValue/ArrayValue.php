<?php

declare(strict_types=1);

namespace ChunkifyAnalytics\OtlpAnyValue;

use ChunkifyAnalytics\Core\Attributes\Optional;
use ChunkifyAnalytics\Core\Concerns\SdkModel;
use ChunkifyAnalytics\Core\Contracts\BaseModel;
use ChunkifyAnalytics\Core\Conversion\ListOf;
use ChunkifyAnalytics\Core\Omit;
use ChunkifyAnalytics\OtlpAnyValue;

/**
 * @phpstan-type ArrayValueShape = array{values?: list<mixed>|null}
 */
final class ArrayValue implements BaseModel
{
    /** @use SdkModel<ArrayValueShape> */
    use SdkModel;

    /** @var list<mixed>|null $values */
    #[Optional(
        type: new ListOf(OtlpAnyValue::class, nullable: true),
        nullable: true
    )]
    public ?array $values;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param list<mixed>|Omit|null $values
     */
    public static function with(array|Omit|null $values = Omit::Value): self
    {
        $self = new self;

        Omit::Value !== $values && $self['values'] = $values;

        return $self;
    }

    /**
     * @param list<mixed>|null $values
     */
    public function withValues(?array $values): self
    {
        $self = clone $this;
        $self['values'] = $values;

        return $self;
    }
}
