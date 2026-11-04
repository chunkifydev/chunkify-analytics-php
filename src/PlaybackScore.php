<?php

declare(strict_types=1);

namespace ChunkifyAnalytics;

use ChunkifyAnalytics\Core\Attributes\Required;
use ChunkifyAnalytics\Core\Concerns\SdkModel;
use ChunkifyAnalytics\Core\Contracts\BaseModel;

/**
 * @phpstan-type PlaybackScoreShape = array{sampleViews: int, value: float|null}
 */
final class PlaybackScore implements BaseModel
{
    /** @use SdkModel<PlaybackScoreShape> */
    use SdkModel;

    /**
     * Sessions contributing a score, including recorded failures. A per-session result is zero or one.
     */
    #[Required('sample_views')]
    public int $sampleViews;

    /**
     * Mean of measured per-session playback scores, or null without scored sessions. Each session uses startup = 8 / (8 + startup_time_ms / 1000), smoothness = exp(-10 * buffering_ratio), and scores 100 * startup^0.30 * smoothness^0.70. Buffering ratio is rebuffer duration divided by playing plus rebuffer duration. The 30% startup and 70% smoothness weights are heuristic. A recorded fatal error or failed_before_start outcome scores zero. Other sessions require positive playing time and known startup and rebuffer durations; ended_before_start and unknown outcomes are unscored. Buffering excludes startup, pauses and seeks. The score does not use interruption count or measure picture quality.
     */
    #[Required]
    public ?float $value;

    /**
     * `new PlaybackScore()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * PlaybackScore::with(sampleViews: ..., value: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new PlaybackScore)->withSampleViews(...)->withValue(...)
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
    public static function with(int $sampleViews, ?float $value): self
    {
        $self = new self;

        $self['sampleViews'] = $sampleViews;
        $self['value'] = $value;

        return $self;
    }

    /**
     * Sessions contributing a score, including recorded failures. A per-session result is zero or one.
     */
    public function withSampleViews(int $sampleViews): self
    {
        $self = clone $this;
        $self['sampleViews'] = $sampleViews;

        return $self;
    }

    /**
     * Mean of measured per-session playback scores, or null without scored sessions. Each session uses startup = 8 / (8 + startup_time_ms / 1000), smoothness = exp(-10 * buffering_ratio), and scores 100 * startup^0.30 * smoothness^0.70. Buffering ratio is rebuffer duration divided by playing plus rebuffer duration. The 30% startup and 70% smoothness weights are heuristic. A recorded fatal error or failed_before_start outcome scores zero. Other sessions require positive playing time and known startup and rebuffer durations; ended_before_start and unknown outcomes are unscored. Buffering excludes startup, pauses and seeks. The score does not use interruption count or measure picture quality.
     */
    public function withValue(?float $value): self
    {
        $self = clone $this;
        $self['value'] = $value;

        return $self;
    }
}
