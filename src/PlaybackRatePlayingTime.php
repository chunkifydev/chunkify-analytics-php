<?php

declare(strict_types=1);

namespace ChunkifyAnalytics;

use ChunkifyAnalytics\Core\Attributes\Required;
use ChunkifyAnalytics\Core\Concerns\SdkModel;
use ChunkifyAnalytics\Core\Contracts\BaseModel;

/**
 * @phpstan-type PlaybackRatePlayingTimeShape = array{
 *   playingTimeMs: float, rate: float
 * }
 */
final class PlaybackRatePlayingTime implements BaseModel
{
    /** @use SdkModel<PlaybackRatePlayingTimeShape> */
    use SdkModel;

    #[Required('playing_time_ms')]
    public float $playingTimeMs;

    /**
     * Playback rate, rounded to two decimals.
     */
    #[Required]
    public float $rate;

    /**
     * `new PlaybackRatePlayingTime()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * PlaybackRatePlayingTime::with(playingTimeMs: ..., rate: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new PlaybackRatePlayingTime)->withPlayingTimeMs(...)->withRate(...)
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
    public static function with(float $playingTimeMs, float $rate): self
    {
        $self = new self;

        $self['playingTimeMs'] = $playingTimeMs;
        $self['rate'] = $rate;

        return $self;
    }

    public function withPlayingTimeMs(float $playingTimeMs): self
    {
        $self = clone $this;
        $self['playingTimeMs'] = $playingTimeMs;

        return $self;
    }

    /**
     * Playback rate, rounded to two decimals.
     */
    public function withRate(float $rate): self
    {
        $self = clone $this;
        $self['rate'] = $rate;

        return $self;
    }
}
