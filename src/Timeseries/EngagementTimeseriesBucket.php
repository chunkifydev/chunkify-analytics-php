<?php

declare(strict_types=1);

namespace ChunkifyAnalytics\Timeseries;

use ChunkifyAnalytics\Core\Attributes\Required;
use ChunkifyAnalytics\Core\Concerns\SdkModel;
use ChunkifyAnalytics\Core\Contracts\BaseModel;
use ChunkifyAnalytics\ProgressReached;
use ChunkifyAnalytics\WatchTimeDistribution;

/**
 * Observed watch time and end-of-media for the same start cohort as summary. Missing delivery can undercount both.
 *
 * @phpstan-import-type ProgressReachedShape from \ChunkifyAnalytics\ProgressReached
 * @phpstan-import-type WatchTimeDistributionShape from \ChunkifyAnalytics\WatchTimeDistribution
 *
 * @phpstan-type EngagementTimeseriesBucketShape = array{
 *   averagePlayingTimeMs: float|null,
 *   bucketStart: \DateTimeInterface,
 *   progressReached: ProgressReached|ProgressReachedShape,
 *   reachedEndRatio: float|null,
 *   reachedEndViews: int,
 *   totalPlayingTimeMs: float,
 *   views: int,
 *   watchTimeMs: WatchTimeDistribution|WatchTimeDistributionShape,
 * }
 */
final class EngagementTimeseriesBucket implements BaseModel
{
    /** @use SdkModel<EngagementTimeseriesBucketShape> */
    use SdkModel;

    /**
     * Total playing time divided by all selected attempts. Null with no views; zero when views exist with no measured time.
     */
    #[Required('average_playing_time_ms')]
    public ?float $averagePlayingTimeMs;

    #[Required('bucket_start')]
    public \DateTimeInterface $bucketStart;

    /**
     * Furthest progress on the selected final event or latest snapshot. Only views with a positive known media duration and a progress ratio in [0,1] are samples. Each milestone ratio uses sample_views. Seeking can count; this is not watched coverage or audience retention.
     */
    #[Required('progress_reached')]
    public ProgressReached $progressReached;

    /**
     * Reached-end views divided by all selected attempts. Null without views. Multiply by 100 for percent. Does not imply the whole video was watched.
     */
    #[Required('reached_end_ratio')]
    public ?float $reachedEndRatio;

    /**
     * Views whose winning final event has reason=ended. Counts each selected view at most once.
     */
    #[Required('reached_end_views')]
    public int $reachedEndViews;

    /**
     * Cumulative playing time summed once per selected view, as in summary.
     */
    #[Required('total_playing_time_ms')]
    public float $totalPlayingTimeMs;

    /**
     * Selected playback attempts with a retained start, including failed, ongoing and start-only attempts.
     */
    #[Required]
    public int $views;

    /**
     * Playing time in milliseconds from one selected final event or latest snapshot per view. Measured zero is included; missing measurements are excluded. Percentiles use linear interpolation and are null without samples. This sample denominator differs from average_playing_time_ms, which uses all attempts.
     */
    #[Required('watch_time_ms')]
    public WatchTimeDistribution $watchTimeMs;

    /**
     * `new EngagementTimeseriesBucket()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * EngagementTimeseriesBucket::with(
     *   averagePlayingTimeMs: ...,
     *   bucketStart: ...,
     *   progressReached: ...,
     *   reachedEndRatio: ...,
     *   reachedEndViews: ...,
     *   totalPlayingTimeMs: ...,
     *   views: ...,
     *   watchTimeMs: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new EngagementTimeseriesBucket)
     *   ->withAveragePlayingTimeMs(...)
     *   ->withBucketStart(...)
     *   ->withProgressReached(...)
     *   ->withReachedEndRatio(...)
     *   ->withReachedEndViews(...)
     *   ->withTotalPlayingTimeMs(...)
     *   ->withViews(...)
     *   ->withWatchTimeMs(...)
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
     *
     * @param ProgressReached|ProgressReachedShape $progressReached
     * @param WatchTimeDistribution|WatchTimeDistributionShape $watchTimeMs
     */
    public static function with(
        ?float $averagePlayingTimeMs,
        \DateTimeInterface $bucketStart,
        ProgressReached|array $progressReached,
        ?float $reachedEndRatio,
        int $reachedEndViews,
        float $totalPlayingTimeMs,
        int $views,
        WatchTimeDistribution|array $watchTimeMs,
    ): self {
        $self = new self;

        $self['averagePlayingTimeMs'] = $averagePlayingTimeMs;
        $self['bucketStart'] = $bucketStart;
        $self['progressReached'] = $progressReached;
        $self['reachedEndRatio'] = $reachedEndRatio;
        $self['reachedEndViews'] = $reachedEndViews;
        $self['totalPlayingTimeMs'] = $totalPlayingTimeMs;
        $self['views'] = $views;
        $self['watchTimeMs'] = $watchTimeMs;

        return $self;
    }

    /**
     * Total playing time divided by all selected attempts. Null with no views; zero when views exist with no measured time.
     */
    public function withAveragePlayingTimeMs(?float $averagePlayingTimeMs): self
    {
        $self = clone $this;
        $self['averagePlayingTimeMs'] = $averagePlayingTimeMs;

        return $self;
    }

    public function withBucketStart(\DateTimeInterface $bucketStart): self
    {
        $self = clone $this;
        $self['bucketStart'] = $bucketStart;

        return $self;
    }

    /**
     * Furthest progress on the selected final event or latest snapshot. Only views with a positive known media duration and a progress ratio in [0,1] are samples. Each milestone ratio uses sample_views. Seeking can count; this is not watched coverage or audience retention.
     *
     * @param ProgressReached|ProgressReachedShape $progressReached
     */
    public function withProgressReached(
        ProgressReached|array $progressReached
    ): self {
        $self = clone $this;
        $self['progressReached'] = $progressReached;

        return $self;
    }

    /**
     * Reached-end views divided by all selected attempts. Null without views. Multiply by 100 for percent. Does not imply the whole video was watched.
     */
    public function withReachedEndRatio(?float $reachedEndRatio): self
    {
        $self = clone $this;
        $self['reachedEndRatio'] = $reachedEndRatio;

        return $self;
    }

    /**
     * Views whose winning final event has reason=ended. Counts each selected view at most once.
     */
    public function withReachedEndViews(int $reachedEndViews): self
    {
        $self = clone $this;
        $self['reachedEndViews'] = $reachedEndViews;

        return $self;
    }

    /**
     * Cumulative playing time summed once per selected view, as in summary.
     */
    public function withTotalPlayingTimeMs(float $totalPlayingTimeMs): self
    {
        $self = clone $this;
        $self['totalPlayingTimeMs'] = $totalPlayingTimeMs;

        return $self;
    }

    /**
     * Selected playback attempts with a retained start, including failed, ongoing and start-only attempts.
     */
    public function withViews(int $views): self
    {
        $self = clone $this;
        $self['views'] = $views;

        return $self;
    }

    /**
     * Playing time in milliseconds from one selected final event or latest snapshot per view. Measured zero is included; missing measurements are excluded. Percentiles use linear interpolation and are null without samples. This sample denominator differs from average_playing_time_ms, which uses all attempts.
     *
     * @param WatchTimeDistribution|WatchTimeDistributionShape $watchTimeMs
     */
    public function withWatchTimeMs(
        WatchTimeDistribution|array $watchTimeMs
    ): self {
        $self = clone $this;
        $self['watchTimeMs'] = $watchTimeMs;

        return $self;
    }
}
