<?php

declare(strict_types=1);

namespace ChunkifyAnalytics\Events;

use ChunkifyAnalytics\Core\Attributes\Required;
use ChunkifyAnalytics\Core\Concerns\SdkModel;
use ChunkifyAnalytics\Core\Contracts\BaseModel;
use ChunkifyAnalytics\Core\Conversion\EnumOf;

/**
 * @phpstan-type NativeCreatedShape = array{accepted: true, duplicate: false}
 */
final class NativeCreated implements BaseModel
{
    /** @use SdkModel<NativeCreatedShape> */
    use SdkModel;

    /** @var true $accepted */
    #[Required(type: new EnumOf([true]))]
    public bool $accepted = true;

    /** @var false $duplicate */
    #[Required(type: new EnumOf([false]))]
    public bool $duplicate = false;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(): self
    {
        return new self;
    }

    /**
     * @param true $accepted
     */
    public function withAccepted(bool $accepted): self
    {
        $self = clone $this;
        $self['accepted'] = $accepted;

        return $self;
    }

    /**
     * @param false $duplicate
     */
    public function withDuplicate(bool $duplicate): self
    {
        $self = clone $this;
        $self['duplicate'] = $duplicate;

        return $self;
    }
}
