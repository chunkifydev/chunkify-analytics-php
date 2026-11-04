<?php

declare(strict_types=1);

namespace ChunkifyAnalytics;

use ChunkifyAnalytics\Core\Attributes\Required;
use ChunkifyAnalytics\Core\Concerns\SdkModel;
use ChunkifyAnalytics\Core\Contracts\BaseModel;

/**
 * @phpstan-type PlayedRangeShape = array{endSeconds: float, startSeconds: float}
 */
final class PlayedRange implements BaseModel
{
    /** @use SdkModel<PlayedRangeShape> */
    use SdkModel;

    /**
     * Exclusive media position in seconds, greater than start_seconds.
     */
    #[Required('end_seconds')]
    public float $endSeconds;

    /**
     * Inclusive media position in seconds.
     */
    #[Required('start_seconds')]
    public float $startSeconds;

    /**
     * `new PlayedRange()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * PlayedRange::with(endSeconds: ..., startSeconds: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new PlayedRange)->withEndSeconds(...)->withStartSeconds(...)
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
    public static function with(float $endSeconds, float $startSeconds): self
    {
        $self = new self;

        $self['endSeconds'] = $endSeconds;
        $self['startSeconds'] = $startSeconds;

        return $self;
    }

    /**
     * Exclusive media position in seconds, greater than start_seconds.
     */
    public function withEndSeconds(float $endSeconds): self
    {
        $self = clone $this;
        $self['endSeconds'] = $endSeconds;

        return $self;
    }

    /**
     * Inclusive media position in seconds.
     */
    public function withStartSeconds(float $startSeconds): self
    {
        $self = clone $this;
        $self['startSeconds'] = $startSeconds;

        return $self;
    }
}
