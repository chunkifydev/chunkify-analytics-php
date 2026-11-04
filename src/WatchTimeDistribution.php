<?php

declare(strict_types=1);

namespace ChunkifyAnalytics;

use ChunkifyAnalytics\Core\Attributes\Required;
use ChunkifyAnalytics\Core\Concerns\SdkModel;
use ChunkifyAnalytics\Core\Contracts\BaseModel;
use ChunkifyAnalytics\WatchTimeDistribution\Distribution;

/**
 * Playing time in milliseconds from one selected final event or latest snapshot per view. Measured zero is included; missing measurements are excluded. Percentiles use linear interpolation and are null without samples. This sample denominator differs from average_playing_time_ms, which uses all attempts.
 *
 * @phpstan-import-type DistributionShape from \ChunkifyAnalytics\WatchTimeDistribution\Distribution
 *
 * @phpstan-type WatchTimeDistributionShape = array{
 *   distribution: Distribution|DistributionShape,
 *   median: float|null,
 *   p95: float|null,
 *   sampleViews: int,
 * }
 */
final class WatchTimeDistribution implements BaseModel
{
    /** @use SdkModel<WatchTimeDistributionShape> */
    use SdkModel;

    /**
     * Mutually exclusive playing-time buckets: [0,10s), [10s,30s), [30s,60s), [1m,5m), [5m,infinity). Counts sum to sample_views.
     */
    #[Required]
    public Distribution $distribution;

    #[Required]
    public ?float $median;

    #[Required]
    public ?float $p95;

    #[Required('sample_views')]
    public int $sampleViews;

    /**
     * `new WatchTimeDistribution()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * WatchTimeDistribution::with(
     *   distribution: ..., median: ..., p95: ..., sampleViews: ...
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new WatchTimeDistribution)
     *   ->withDistribution(...)
     *   ->withMedian(...)
     *   ->withP95(...)
     *   ->withSampleViews(...)
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
     * @param Distribution|DistributionShape $distribution
     */
    public static function with(
        Distribution|array $distribution,
        ?float $median,
        ?float $p95,
        int $sampleViews,
    ): self {
        $self = new self;

        $self['distribution'] = $distribution;
        $self['median'] = $median;
        $self['p95'] = $p95;
        $self['sampleViews'] = $sampleViews;

        return $self;
    }

    /**
     * Mutually exclusive playing-time buckets: [0,10s), [10s,30s), [30s,60s), [1m,5m), [5m,infinity). Counts sum to sample_views.
     *
     * @param Distribution|DistributionShape $distribution
     */
    public function withDistribution(Distribution|array $distribution): self
    {
        $self = clone $this;
        $self['distribution'] = $distribution;

        return $self;
    }

    public function withMedian(?float $median): self
    {
        $self = clone $this;
        $self['median'] = $median;

        return $self;
    }

    public function withP95(?float $p95): self
    {
        $self = clone $this;
        $self['p95'] = $p95;

        return $self;
    }

    public function withSampleViews(int $sampleViews): self
    {
        $self = clone $this;
        $self['sampleViews'] = $sampleViews;

        return $self;
    }
}
