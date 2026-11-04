<?php

declare(strict_types=1);

namespace ChunkifyAnalytics\Events;

use ChunkifyAnalytics\Core\Attributes\Required;
use ChunkifyAnalytics\Core\Concerns\SdkModel;
use ChunkifyAnalytics\Core\Contracts\BaseModel;
use ChunkifyAnalytics\Core\Conversion\EnumOf;

/**
 * @phpstan-type NativeDuplicateShape = array{accepted: false, duplicate: true}
 */
final class NativeDuplicate implements BaseModel
{
    /** @use SdkModel<NativeDuplicateShape> */
    use SdkModel;

    /** @var false $accepted */
    #[Required(type: new EnumOf([false]))]
    public bool $accepted = false;

    /** @var true $duplicate */
    #[Required(type: new EnumOf([true]))]
    public bool $duplicate = true;

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
     * @param false $accepted
     */
    public function withAccepted(bool $accepted): self
    {
        $self = clone $this;
        $self['accepted'] = $accepted;

        return $self;
    }

    /**
     * @param true $duplicate
     */
    public function withDuplicate(bool $duplicate): self
    {
        $self = clone $this;
        $self['duplicate'] = $duplicate;

        return $self;
    }
}
