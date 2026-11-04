<?php

declare(strict_types=1);

namespace ChunkifyAnalytics;

use ChunkifyAnalytics\Core\Attributes\Optional;
use ChunkifyAnalytics\Core\Concerns\SdkModel;
use ChunkifyAnalytics\Core\Contracts\BaseModel;
use ChunkifyAnalytics\Core\Omit;
use ChunkifyAnalytics\OtlpAnyValue\ArrayValue;
use ChunkifyAnalytics\OtlpAnyValue\KvlistValue;

/**
 * Standard OTLP AnyValue in a preserved resource, scope or body. This collector does not decode these fields into the event.
 *
 * @phpstan-import-type IntValueVariants from \ChunkifyAnalytics\OtlpAnyValue\IntValue
 * @phpstan-import-type ArrayValueShape from \ChunkifyAnalytics\OtlpAnyValue\ArrayValue
 * @phpstan-import-type IntValueShape from \ChunkifyAnalytics\OtlpAnyValue\IntValue
 * @phpstan-import-type KvlistValueShape from \ChunkifyAnalytics\OtlpAnyValue\KvlistValue
 *
 * @phpstan-type OtlpAnyValueShape = array{
 *   arrayValue?: null|ArrayValue|ArrayValueShape,
 *   boolValue?: bool|null,
 *   bytesValue?: string|null,
 *   doubleValue?: float|null,
 *   intValue?: IntValueShape|null,
 *   kvlistValue?: null|KvlistValue|KvlistValueShape,
 *   stringValue?: string|null,
 * }
 */
final class OtlpAnyValue implements BaseModel
{
    /** @use SdkModel<OtlpAnyValueShape> */
    use SdkModel;

    #[Optional(nullable: true)]
    public ?ArrayValue $arrayValue;

    #[Optional(nullable: true)]
    public ?bool $boolValue;

    #[Optional(nullable: true)]
    public ?string $bytesValue;

    #[Optional(nullable: true)]
    public ?float $doubleValue;

    /**
     * Signed int64. Strings avoid JavaScript precision loss.
     *
     * @var IntValueVariants|null $intValue
     */
    #[Optional(nullable: true)]
    public string|int|null $intValue;

    #[Optional(nullable: true)]
    public ?KvlistValue $kvlistValue;

    #[Optional(nullable: true)]
    public ?string $stringValue;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param Omit|ArrayValue|ArrayValueShape|null $arrayValue
     * @param IntValueShape|Omit|null $intValue
     * @param Omit|KvlistValue|KvlistValueShape|null $kvlistValue
     */
    public static function with(
        Omit|ArrayValue|array|null $arrayValue = Omit::Value,
        bool|Omit|null $boolValue = Omit::Value,
        string|Omit|null $bytesValue = Omit::Value,
        float|Omit|null $doubleValue = Omit::Value,
        Omit|string|int|null $intValue = Omit::Value,
        Omit|KvlistValue|array|null $kvlistValue = Omit::Value,
        string|Omit|null $stringValue = Omit::Value,
    ): self {
        $self = new self;

        Omit::Value !== $arrayValue && $self['arrayValue'] = $arrayValue;
        Omit::Value !== $boolValue && $self['boolValue'] = $boolValue;
        Omit::Value !== $bytesValue && $self['bytesValue'] = $bytesValue;
        Omit::Value !== $doubleValue && $self['doubleValue'] = $doubleValue;
        Omit::Value !== $intValue && $self['intValue'] = $intValue;
        Omit::Value !== $kvlistValue && $self['kvlistValue'] = $kvlistValue;
        Omit::Value !== $stringValue && $self['stringValue'] = $stringValue;

        return $self;
    }

    /**
     * @param ArrayValue|ArrayValueShape|null $arrayValue
     */
    public function withArrayValue(ArrayValue|array|null $arrayValue): self
    {
        $self = clone $this;
        $self['arrayValue'] = $arrayValue;

        return $self;
    }

    public function withBoolValue(?bool $boolValue): self
    {
        $self = clone $this;
        $self['boolValue'] = $boolValue;

        return $self;
    }

    public function withBytesValue(?string $bytesValue): self
    {
        $self = clone $this;
        $self['bytesValue'] = $bytesValue;

        return $self;
    }

    public function withDoubleValue(?float $doubleValue): self
    {
        $self = clone $this;
        $self['doubleValue'] = $doubleValue;

        return $self;
    }

    /**
     * Signed int64. Strings avoid JavaScript precision loss.
     *
     * @param IntValueShape|null $intValue
     */
    public function withIntValue(string|int|null $intValue): self
    {
        $self = clone $this;
        $self['intValue'] = $intValue;

        return $self;
    }

    /**
     * @param KvlistValue|KvlistValueShape|null $kvlistValue
     */
    public function withKvlistValue(KvlistValue|array|null $kvlistValue): self
    {
        $self = clone $this;
        $self['kvlistValue'] = $kvlistValue;

        return $self;
    }

    public function withStringValue(?string $stringValue): self
    {
        $self = clone $this;
        $self['stringValue'] = $stringValue;

        return $self;
    }
}
