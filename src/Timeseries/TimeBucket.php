<?php

declare(strict_types=1);

namespace ChunkifyAnalytics\Timeseries;

use ChunkifyAnalytics\Core\Attributes\Required;
use ChunkifyAnalytics\Core\Concerns\SdkModel;
use ChunkifyAnalytics\Core\Contracts\BaseModel;

/**
 * @phpstan-type TimeBucketShape = array{
 *   bucketStart: \DateTimeInterface,
 *   totalPlayingTimeMs: float,
 *   uniqueViewers: int,
 *   views: int,
 * }
 */
final class TimeBucket implements BaseModel
{
    /** @use SdkModel<TimeBucketShape> */
    use SdkModel;

    /**
     * UTC interval start in RFC3339 with milliseconds and Z. May precede from in a partial first bucket; only starts inside [from, to) contribute.
     */
    #[Required('bucket_start')]
    public \DateTimeInterface $bucketStart;

    #[Required('total_playing_time_ms')]
    public float $totalPlayingTimeMs;

    #[Required('unique_viewers')]
    public int $uniqueViewers;

    #[Required]
    public int $views;

    /**
     * `new TimeBucket()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * TimeBucket::with(
     *   bucketStart: ..., totalPlayingTimeMs: ..., uniqueViewers: ..., views: ...
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new TimeBucket)
     *   ->withBucketStart(...)
     *   ->withTotalPlayingTimeMs(...)
     *   ->withUniqueViewers(...)
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
        \DateTimeInterface $bucketStart,
        float $totalPlayingTimeMs,
        int $uniqueViewers,
        int $views,
    ): self {
        $self = new self;

        $self['bucketStart'] = $bucketStart;
        $self['totalPlayingTimeMs'] = $totalPlayingTimeMs;
        $self['uniqueViewers'] = $uniqueViewers;
        $self['views'] = $views;

        return $self;
    }

    /**
     * UTC interval start in RFC3339 with milliseconds and Z. May precede from in a partial first bucket; only starts inside [from, to) contribute.
     */
    public function withBucketStart(\DateTimeInterface $bucketStart): self
    {
        $self = clone $this;
        $self['bucketStart'] = $bucketStart;

        return $self;
    }

    public function withTotalPlayingTimeMs(float $totalPlayingTimeMs): self
    {
        $self = clone $this;
        $self['totalPlayingTimeMs'] = $totalPlayingTimeMs;

        return $self;
    }

    public function withUniqueViewers(int $uniqueViewers): self
    {
        $self = clone $this;
        $self['uniqueViewers'] = $uniqueViewers;

        return $self;
    }

    public function withViews(int $views): self
    {
        $self = clone $this;
        $self['views'] = $views;

        return $self;
    }
}
