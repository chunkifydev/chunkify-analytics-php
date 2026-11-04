<?php

declare(strict_types=1);

namespace ChunkifyAnalytics;

use ChunkifyAnalytics\Core\Attributes\Optional;
use ChunkifyAnalytics\Core\Concerns\SdkModel;
use ChunkifyAnalytics\Core\Contracts\BaseModel;
use ChunkifyAnalytics\Core\Omit;

/**
 * @phpstan-type OtlpResourceShape = array{
 *   attributes?: list<mixed>|null, droppedAttributesCount?: int|null
 * }
 */
final class OtlpResource implements BaseModel
{
    /** @use SdkModel<OtlpResourceShape> */
    use SdkModel;

    /** @var list<mixed>|null $attributes */
    #[Optional(list: OtlpContextAttribute::class, nullable: true)]
    public ?array $attributes;

    #[Optional(nullable: true)]
    public ?int $droppedAttributesCount;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param list<mixed>|Omit|null $attributes
     */
    public static function with(
        array|Omit|null $attributes = Omit::Value,
        int|Omit|null $droppedAttributesCount = Omit::Value,
    ): self {
        $self = new self;

        Omit::Value !== $attributes && $self['attributes'] = $attributes;
        Omit::Value !== $droppedAttributesCount && $self['droppedAttributesCount'] = $droppedAttributesCount;

        return $self;
    }

    /**
     * @param list<mixed>|null $attributes
     */
    public function withAttributes(?array $attributes): self
    {
        $self = clone $this;
        $self['attributes'] = $attributes;

        return $self;
    }

    public function withDroppedAttributesCount(
        ?int $droppedAttributesCount
    ): self {
        $self = clone $this;
        $self['droppedAttributesCount'] = $droppedAttributesCount;

        return $self;
    }
}
