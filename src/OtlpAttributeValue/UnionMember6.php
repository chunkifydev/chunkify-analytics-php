<?php

declare(strict_types=1);

namespace ChunkifyAnalytics\OtlpAttributeValue;

use ChunkifyAnalytics\Core\Attributes\Optional;
use ChunkifyAnalytics\Core\Attributes\Required;
use ChunkifyAnalytics\Core\Concerns\SdkModel;
use ChunkifyAnalytics\Core\Contracts\BaseModel;
use ChunkifyAnalytics\Core\Omit;

/**
 * @phpstan-type UnionMember6Shape = array{
 *   kvlistValue: mixed,
 *   arrayValue?: null|null,
 *   boolValue?: null|null,
 *   bytesValue?: null|null,
 *   doubleValue?: null|null,
 *   intValue?: null|null,
 *   stringValue?: null|null,
 * }
 */
final class UnionMember6 implements BaseModel
{
    /** @use SdkModel<UnionMember6Shape> */
    use SdkModel;

    #[Required]
    public mixed $kvlistValue;

    /** @var null|null $arrayValue */
    #[Optional(nullable: true)]
    public null $arrayValue;

    /** @var null|null $boolValue */
    #[Optional(nullable: true)]
    public null $boolValue;

    /** @var null|null $bytesValue */
    #[Optional(nullable: true)]
    public null $bytesValue;

    /** @var null|null $doubleValue */
    #[Optional(nullable: true)]
    public null $doubleValue;

    /** @var null|null $intValue */
    #[Optional(nullable: true)]
    public null $intValue;

    /** @var null|null $stringValue */
    #[Optional(nullable: true)]
    public null $stringValue;

    /**
     * `new UnionMember6()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * UnionMember6::with(kvlistValue: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new UnionMember6)->withKvlistValue(...)
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
    public static function with(
        mixed $kvlistValue,
        ?Omit $arrayValue = Omit::Value,
        ?Omit $boolValue = Omit::Value,
        ?Omit $bytesValue = Omit::Value,
        ?Omit $doubleValue = Omit::Value,
        ?Omit $intValue = Omit::Value,
        ?Omit $stringValue = Omit::Value,
    ): self {
        $self = new self;

        $self['kvlistValue'] = $kvlistValue;

        Omit::Value !== $arrayValue && $self['arrayValue'] = $arrayValue;
        Omit::Value !== $boolValue && $self['boolValue'] = $boolValue;
        Omit::Value !== $bytesValue && $self['bytesValue'] = $bytesValue;
        Omit::Value !== $doubleValue && $self['doubleValue'] = $doubleValue;
        Omit::Value !== $intValue && $self['intValue'] = $intValue;
        Omit::Value !== $stringValue && $self['stringValue'] = $stringValue;

        return $self;
    }

    public function withKvlistValue(mixed $kvlistValue): self
    {
        $self = clone $this;
        $self['kvlistValue'] = $kvlistValue;

        return $self;
    }

    /**
     * @param null|null $arrayValue
     */
    public function withArrayValue(null $arrayValue): self
    {
        $self = clone $this;
        $self['arrayValue'] = $arrayValue;

        return $self;
    }

    /**
     * @param null|null $boolValue
     */
    public function withBoolValue(null $boolValue): self
    {
        $self = clone $this;
        $self['boolValue'] = $boolValue;

        return $self;
    }

    /**
     * @param null|null $bytesValue
     */
    public function withBytesValue(null $bytesValue): self
    {
        $self = clone $this;
        $self['bytesValue'] = $bytesValue;

        return $self;
    }

    /**
     * @param null|null $doubleValue
     */
    public function withDoubleValue(null $doubleValue): self
    {
        $self = clone $this;
        $self['doubleValue'] = $doubleValue;

        return $self;
    }

    /**
     * @param null|null $intValue
     */
    public function withIntValue(null $intValue): self
    {
        $self = clone $this;
        $self['intValue'] = $intValue;

        return $self;
    }

    /**
     * @param null|null $stringValue
     */
    public function withStringValue(null $stringValue): self
    {
        $self = clone $this;
        $self['stringValue'] = $stringValue;

        return $self;
    }
}
