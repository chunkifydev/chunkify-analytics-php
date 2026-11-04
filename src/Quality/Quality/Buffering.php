<?php

declare(strict_types=1);

namespace ChunkifyAnalytics\Quality\Quality;

use ChunkifyAnalytics\Core\Attributes\Required;
use ChunkifyAnalytics\Core\Concerns\SdkModel;
use ChunkifyAnalytics\Core\Contracts\BaseModel;

/**
 * Duration-weighted buffering. Startup wait, pauses and seeking are excluded by the SDK. Unknown durations are not treated as zero.
 *
 * @phpstan-type BufferingShape = array{
 *   ratio: float|null,
 *   sampleViews: int,
 *   totalPlayingTimeMs: float,
 *   totalRebufferDurationMs: float,
 * }
 */
final class Buffering implements BaseModel
{
    /** @use SdkModel<BufferingShape> */
    use SdkModel;

    /**
     * Total rebuffer time divided by combined playing and rebuffer time. Null without samples. Multiply by 100 for percent.
     */
    #[Required]
    public ?float $ratio;

    /**
     * Views with playing and rebuffer durations available and positive combined duration.
     */
    #[Required('sample_views')]
    public int $sampleViews;

    /**
     * Sum of playing time for eligible buffering samples only.
     */
    #[Required('total_playing_time_ms')]
    public float $totalPlayingTimeMs;

    /**
     * Sum of rebuffer time for the same samples.
     */
    #[Required('total_rebuffer_duration_ms')]
    public float $totalRebufferDurationMs;

    /**
     * `new Buffering()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Buffering::with(
     *   ratio: ...,
     *   sampleViews: ...,
     *   totalPlayingTimeMs: ...,
     *   totalRebufferDurationMs: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Buffering)
     *   ->withRatio(...)
     *   ->withSampleViews(...)
     *   ->withTotalPlayingTimeMs(...)
     *   ->withTotalRebufferDurationMs(...)
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
        ?float $ratio,
        int $sampleViews,
        float $totalPlayingTimeMs,
        float $totalRebufferDurationMs,
    ): self {
        $self = new self;

        $self['ratio'] = $ratio;
        $self['sampleViews'] = $sampleViews;
        $self['totalPlayingTimeMs'] = $totalPlayingTimeMs;
        $self['totalRebufferDurationMs'] = $totalRebufferDurationMs;

        return $self;
    }

    /**
     * Total rebuffer time divided by combined playing and rebuffer time. Null without samples. Multiply by 100 for percent.
     */
    public function withRatio(?float $ratio): self
    {
        $self = clone $this;
        $self['ratio'] = $ratio;

        return $self;
    }

    /**
     * Views with playing and rebuffer durations available and positive combined duration.
     */
    public function withSampleViews(int $sampleViews): self
    {
        $self = clone $this;
        $self['sampleViews'] = $sampleViews;

        return $self;
    }

    /**
     * Sum of playing time for eligible buffering samples only.
     */
    public function withTotalPlayingTimeMs(float $totalPlayingTimeMs): self
    {
        $self = clone $this;
        $self['totalPlayingTimeMs'] = $totalPlayingTimeMs;

        return $self;
    }

    /**
     * Sum of rebuffer time for the same samples.
     */
    public function withTotalRebufferDurationMs(
        float $totalRebufferDurationMs
    ): self {
        $self = clone $this;
        $self['totalRebufferDurationMs'] = $totalRebufferDurationMs;

        return $self;
    }
}
