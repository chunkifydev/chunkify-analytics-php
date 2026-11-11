<?php

declare(strict_types=1);

namespace ChunkifyAnalytics\PlaybackRates;

use ChunkifyAnalytics\Core\Attributes\Required;
use ChunkifyAnalytics\Core\Concerns\SdkModel;
use ChunkifyAnalytics\Core\Contracts\BaseModel;

/**
 * Watch time at one playback rate.
 *
 * @phpstan-type PlaybackRateMetricShape = array{
 *   playingTimeMs: float, playingTimeRatio: float, rate: float, views: int
 * }
 */
final class PlaybackRateMetric implements BaseModel
{
    /** @use SdkModel<PlaybackRateMetricShape> */
    use SdkModel;

    /**
     * Cumulative measured playing time at this rate, summed once per attempt.
     */
    #[Required('playing_time_ms')]
    public float $playingTimeMs;

    /**
     * Share of all measured playing time, including rows outside the returned limit.
     */
    #[Required('playing_time_ratio')]
    public float $playingTimeRatio;

    /**
     * Playback rate, rounded to two decimals.
     */
    #[Required]
    public float $rate;

    /**
     * Distinct attempts with positive playing time at this rate.
     */
    #[Required]
    public int $views;

    /**
     * `new PlaybackRateMetric()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * PlaybackRateMetric::with(
     *   playingTimeMs: ..., playingTimeRatio: ..., rate: ..., views: ...
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new PlaybackRateMetric)
     *   ->withPlayingTimeMs(...)
     *   ->withPlayingTimeRatio(...)
     *   ->withRate(...)
     *   ->withViews(...)
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
        float $playingTimeMs,
        float $playingTimeRatio,
        float $rate,
        int $views
    ): self {
        $self = new self;

        $self['playingTimeMs'] = $playingTimeMs;
        $self['playingTimeRatio'] = $playingTimeRatio;
        $self['rate'] = $rate;
        $self['views'] = $views;

        return $self;
    }

    /**
     * Cumulative measured playing time at this rate, summed once per attempt.
     */
    public function withPlayingTimeMs(float $playingTimeMs): self
    {
        $self = clone $this;
        $self['playingTimeMs'] = $playingTimeMs;

        return $self;
    }

    /**
     * Share of all measured playing time, including rows outside the returned limit.
     */
    public function withPlayingTimeRatio(float $playingTimeRatio): self
    {
        $self = clone $this;
        $self['playingTimeRatio'] = $playingTimeRatio;

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

    /**
     * Distinct attempts with positive playing time at this rate.
     */
    public function withViews(int $views): self
    {
        $self = clone $this;
        $self['views'] = $views;

        return $self;
    }
}
