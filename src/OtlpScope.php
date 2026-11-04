<?php

declare(strict_types=1);

namespace ChunkifyAnalytics;

use ChunkifyAnalytics\Core\Attributes\Optional;
use ChunkifyAnalytics\Core\Concerns\SdkModel;
use ChunkifyAnalytics\Core\Contracts\BaseModel;
use ChunkifyAnalytics\Core\Omit;

/**
 * @phpstan-type OtlpScopeShape = array{
 *   attributes?: list<mixed>|null,
 *   droppedAttributesCount?: int|null,
 *   name?: string|null,
 *   version?: string|null,
 * }
 */
final class OtlpScope implements BaseModel
{
    /** @use SdkModel<OtlpScopeShape> */
    use SdkModel;

    /** @var list<mixed>|null $attributes */
    #[Optional(list: OtlpContextAttribute::class, nullable: true)]
    public ?array $attributes;

    #[Optional(nullable: true)]
    public ?int $droppedAttributesCount;

    #[Optional(nullable: true)]
    public ?string $name;

    #[Optional(nullable: true)]
    public ?string $version;

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
        string|Omit|null $name = Omit::Value,
        string|Omit|null $version = Omit::Value,
    ): self {
        $self = new self;

        Omit::Value !== $attributes && $self['attributes'] = $attributes;
        Omit::Value !== $droppedAttributesCount && $self['droppedAttributesCount'] = $droppedAttributesCount;
        Omit::Value !== $name && $self['name'] = $name;
        Omit::Value !== $version && $self['version'] = $version;

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

    public function withName(?string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }

    public function withVersion(?string $version): self
    {
        $self = clone $this;
        $self['version'] = $version;

        return $self;
    }
}
