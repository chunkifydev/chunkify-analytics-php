<?php

declare(strict_types=1);

namespace ChunkifyAnalytics\OtlpAttributeValue;

use ChunkifyAnalytics\Core\Attributes\Optional;
use ChunkifyAnalytics\Core\Attributes\Required;
use ChunkifyAnalytics\Core\Concerns\SdkModel;
use ChunkifyAnalytics\Core\Contracts\BaseModel;
use ChunkifyAnalytics\Core\Omit;

/**
 * @phpstan-type UnionMember1Shape = array{
 *   stringValue: mixed,
 *   arrayValue?: null|null,
 *   boolValue?: null|null,
 *   bytesValue?: null|null,
 *   doubleValue?: null|null,
 *   intValue?: null|null,
 *   kvlistValue?: null|null,
 * }
 */
final class UnionMember1 implements BaseModel
{
    /** @use SdkModel<UnionMember1Shape> */
    use SdkModel;

    #[Required]
    public mixed $stringValue;

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

    /** @var null|null $kvlistValue */
    #[Optional(nullable: true)]
    public null $kvlistValue;

    /**
     * `new UnionMember1()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * UnionMember1::with(stringValue: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new UnionMember1)->withStringValue(...)
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
        mixed $stringValue,
        ?Omit $arrayValue = Omit::Value,
        ?Omit $boolValue = Omit::Value,
        ?Omit $bytesValue = Omit::Value,
        ?Omit $doubleValue = Omit::Value,
        ?Omit $intValue = Omit::Value,
        ?Omit $kvlistValue = Omit::Value,
    ): self {
        $self = new self;

        $self['stringValue'] = $stringValue;

        Omit::Value !== $arrayValue && $self['arrayValue'] = $arrayValue;
        Omit::Value !== $boolValue && $self['boolValue'] = $boolValue;
        Omit::Value !== $bytesValue && $self['bytesValue'] = $bytesValue;
        Omit::Value !== $doubleValue && $self['doubleValue'] = $doubleValue;
        Omit::Value !== $intValue && $self['intValue'] = $intValue;
        Omit::Value !== $kvlistValue && $self['kvlistValue'] = $kvlistValue;

        return $self;
    }

    public function withStringValue(mixed $stringValue): self
    {
        $self = clone $this;
        $self['stringValue'] = $stringValue;

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
     * @param null|null $kvlistValue
     */
    public function withKvlistValue(null $kvlistValue): self
    {
        $self = clone $this;
        $self['kvlistValue'] = $kvlistValue;

        return $self;
    }
}
