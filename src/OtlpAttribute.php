<?php

declare(strict_types=1);

namespace ChunkifyAnalytics;

use ChunkifyAnalytics\Core\Attributes\Optional;
use ChunkifyAnalytics\Core\Concerns\SdkModel;
use ChunkifyAnalytics\Core\Contracts\BaseModel;
use ChunkifyAnalytics\Core\Omit;

/**
 * An absent or null key decodes to the empty string; duplicate decoded keys reject the request. An absent value decodes to null.
 *
 * @phpstan-type OtlpAttributeShape = array{key?: string|null, value?: mixed}
 */
final class OtlpAttribute implements BaseModel
{
    /** @use SdkModel<OtlpAttributeShape> */
    use SdkModel;

    #[Optional(nullable: true)]
    public ?string $key;

    /**
     * A typed log attribute. At most one value field can be set. Binary values are unsupported.
     */
    #[Optional(nullable: true)]
    public mixed $value;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param mixed|Omit|null $value
     */
    public static function with(
        string|Omit|null $key = Omit::Value,
        mixed $value = Omit::Value
    ): self {
        $self = new self;

        Omit::Value !== $key && $self['key'] = $key;
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
     * A typed log attribute. At most one value field can be set. Binary values are unsupported.
     */
    public function withValue(mixed $value): self
    {
        $self = clone $this;
        $self['value'] = $value;

        return $self;
    }
}
