<?php

declare(strict_types=1);

namespace ChunkifyAnalytics\OtlpAttributeValue;

use ChunkifyAnalytics\Core\Attributes\Optional;
use ChunkifyAnalytics\Core\Attributes\Required;
use ChunkifyAnalytics\Core\Concerns\SdkModel;
use ChunkifyAnalytics\Core\Contracts\BaseModel;
use ChunkifyAnalytics\Core\Omit;

/**
 * @phpstan-type UnionMember4Shape = array{
 *   doubleValue: mixed,
 *   arrayValue?: null|null,
 *   boolValue?: null|null,
 *   bytesValue?: null|null,
 *   intValue?: null|null,
 *   kvlistValue?: null|null,
 *   stringValue?: null|null,
 * }
 */
final class UnionMember4 implements BaseModel
{
    /** @use SdkModel<UnionMember4Shape> */
    use SdkModel;

    #[Required]
    public mixed $doubleValue;

    /** @var null|null $arrayValue */
    #[Optional(nullable: true)]
    public null $arrayValue;

    /** @var null|null $boolValue */
    #[Optional(nullable: true)]
    public null $boolValue;

    /** @var null|null $bytesValue */
    #[Optional(nullable: true)]
    public null $bytesValue;

    /** @var null|null $intValue */
    #[Optional(nullable: true)]
    public null $intValue;

    /** @var null|null $kvlistValue */
    #[Optional(nullable: true)]
    public null $kvlistValue;

    /** @var null|null $stringValue */
    #[Optional(nullable: true)]
    public null $stringValue;

    /**
     * `new UnionMember4()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * UnionMember4::with(doubleValue: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new UnionMember4)->withDoubleValue(...)
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
        mixed $doubleValue,
        ?Omit $arrayValue = Omit::Value,
        ?Omit $boolValue = Omit::Value,
        ?Omit $bytesValue = Omit::Value,
        ?Omit $intValue = Omit::Value,
        ?Omit $kvlistValue = Omit::Value,
        ?Omit $stringValue = Omit::Value,
    ): self {
        $self = new self;

        $self['doubleValue'] = $doubleValue;

        Omit::Value !== $arrayValue && $self['arrayValue'] = $arrayValue;
        Omit::Value !== $boolValue && $self['boolValue'] = $boolValue;
        Omit::Value !== $bytesValue && $self['bytesValue'] = $bytesValue;
        Omit::Value !== $intValue && $self['intValue'] = $intValue;
        Omit::Value !== $kvlistValue && $self['kvlistValue'] = $kvlistValue;
        Omit::Value !== $stringValue && $self['stringValue'] = $stringValue;

        return $self;
    }

    public function withDoubleValue(mixed $doubleValue): self
    {
        $self = clone $this;
        $self['doubleValue'] = $doubleValue;

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
