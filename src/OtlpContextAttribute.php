<?php

declare(strict_types=1);

namespace ChunkifyAnalytics;

use ChunkifyAnalytics\Core\Attributes\Optional;
use ChunkifyAnalytics\Core\Attributes\Required;
use ChunkifyAnalytics\Core\Concerns\SdkModel;
use ChunkifyAnalytics\Core\Contracts\BaseModel;
use ChunkifyAnalytics\Core\Omit;

/**
 * @phpstan-type OtlpContextAttributeShape = array{
 *   key: string|null, value?: OtlpAnyValue|null
 * }
 */
final class OtlpContextAttribute implements BaseModel
{
    /** @use SdkModel<OtlpContextAttributeShape> */
    use SdkModel;

    #[Required]
    public ?string $key;

    /**
     * Standard OTLP AnyValue in a preserved resource, scope or body. This collector does not decode these fields into the event.
     */
    #[Optional(nullable: true)]
    public ?OtlpAnyValue $value;

    /**
     * `new OtlpContextAttribute()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * OtlpContextAttribute::with(key: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new OtlpContextAttribute)->withKey(...)
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
        ?string $key,
        OtlpAnyValue|Omit|null $value = Omit::Value
    ): self {
        $self = new self;

        $self['key'] = $key;

        Omit::Value !== $value && $self['value'] = $value;

        return $self;
    }

    public function withKey(?string $key): self
    {
        $self = clone $this;
        $self['key'] = $key;

        return $self;
    }

    /**
     * Standard OTLP AnyValue in a preserved resource, scope or body. This collector does not decode these fields into the event.
     */
    public function withValue(?OtlpAnyValue $value): self
    {
        $self = clone $this;
        $self['value'] = $value;

        return $self;
    }
}
