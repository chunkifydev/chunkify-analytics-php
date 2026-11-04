<?php

declare(strict_types=1);

namespace ChunkifyAnalytics\Quality\Quality;

use ChunkifyAnalytics\Core\Attributes\Required;
use ChunkifyAnalytics\Core\Concerns\SdkModel;
use ChunkifyAnalytics\Core\Contracts\BaseModel;

/**
 * Time from attempt to first playing, measured once per eligible view. This is not first-frame timing.
 *
 * @phpstan-type StartupTimeMsShape = array{
 *   median: float|null, p95: float|null, sampleViews: int
 * }
 */
final class StartupTimeMs implements BaseModel
{
    /** @use SdkModel<StartupTimeMsShape> */
    use SdkModel;

    /**
     * Continuous median startup time in milliseconds, or null without samples.
     */
    #[Required]
    public ?float $median;

    /**
     * Continuous 95th percentile startup time in milliseconds, or null without samples.
     */
    #[Required]
    public ?float $p95;

    /**
     * Views with a non-null startup measurement on the selected final event or latest snapshot.
     */
    #[Required('sample_views')]
    public int $sampleViews;

    /**
     * `new StartupTimeMs()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * StartupTimeMs::with(median: ..., p95: ..., sampleViews: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new StartupTimeMs)->withMedian(...)->withP95(...)->withSampleViews(...)
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
        ?float $median,
        ?float $p95,
        int $sampleViews
    ): self {
        $self = new self;

        $self['median'] = $median;
        $self['p95'] = $p95;
        $self['sampleViews'] = $sampleViews;

        return $self;
    }

    /**
     * Continuous median startup time in milliseconds, or null without samples.
     */
    public function withMedian(?float $median): self
    {
        $self = clone $this;
        $self['median'] = $median;

        return $self;
    }

    /**
     * Continuous 95th percentile startup time in milliseconds, or null without samples.
     */
    public function withP95(?float $p95): self
    {
        $self = clone $this;
        $self['p95'] = $p95;

        return $self;
    }

    /**
     * Views with a non-null startup measurement on the selected final event or latest snapshot.
     */
    public function withSampleViews(int $sampleViews): self
    {
        $self = clone $this;
        $self['sampleViews'] = $sampleViews;

        return $self;
    }
}
