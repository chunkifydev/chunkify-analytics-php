<?php

declare(strict_types=1);

namespace ChunkifyAnalytics;

use ChunkifyAnalytics\Core\Attributes\Required;
use ChunkifyAnalytics\Core\Concerns\SdkModel;
use ChunkifyAnalytics\Core\Contracts\BaseModel;

/**
 * Mutually exclusive outcomes. An explicit startup_outcome on the selected final event takes precedence. Otherwise an available startup time, including zero, or positive playing time on the selected measurement proves started. All other views are unknown. sample_views excludes unknown; every ratio uses all selected attempts, including unknown. Missing final delivery does not prove an exit or failure.
 *
 * @phpstan-import-type MetricCountRatioShape from \ChunkifyAnalytics\MetricCountRatio
 *
 * @phpstan-type StartupOutcomesShape = array{
 *   endedBeforeStart: MetricCountRatio|MetricCountRatioShape,
 *   failedBeforeStart: MetricCountRatio|MetricCountRatioShape,
 *   sampleViews: int,
 *   started: MetricCountRatio|MetricCountRatioShape,
 *   unknown: MetricCountRatio|MetricCountRatioShape,
 * }
 */
final class StartupOutcomes implements BaseModel
{
    /** @use SdkModel<StartupOutcomesShape> */
    use SdkModel;

    /**
     * View count and fraction of its documented denominator. The ratio is null when that denominator is zero.
     */
    #[Required('ended_before_start')]
    public MetricCountRatio $endedBeforeStart;

    /**
     * View count and fraction of its documented denominator. The ratio is null when that denominator is zero.
     */
    #[Required('failed_before_start')]
    public MetricCountRatio $failedBeforeStart;

    #[Required('sample_views')]
    public int $sampleViews;

    /**
     * View count and fraction of its documented denominator. The ratio is null when that denominator is zero.
     */
    #[Required]
    public MetricCountRatio $started;

    /**
     * View count and fraction of its documented denominator. The ratio is null when that denominator is zero.
     */
    #[Required]
    public MetricCountRatio $unknown;

    /**
     * `new StartupOutcomes()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * StartupOutcomes::with(
     *   endedBeforeStart: ...,
     *   failedBeforeStart: ...,
     *   sampleViews: ...,
     *   started: ...,
     *   unknown: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new StartupOutcomes)
     *   ->withEndedBeforeStart(...)
     *   ->withFailedBeforeStart(...)
     *   ->withSampleViews(...)
     *   ->withStarted(...)
     *   ->withUnknown(...)
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
     * @param MetricCountRatio|MetricCountRatioShape $endedBeforeStart
     * @param MetricCountRatio|MetricCountRatioShape $failedBeforeStart
     * @param MetricCountRatio|MetricCountRatioShape $started
     * @param MetricCountRatio|MetricCountRatioShape $unknown
     */
    public static function with(
        MetricCountRatio|array $endedBeforeStart,
        MetricCountRatio|array $failedBeforeStart,
        int $sampleViews,
        MetricCountRatio|array $started,
        MetricCountRatio|array $unknown,
    ): self {
        $self = new self;

        $self['endedBeforeStart'] = $endedBeforeStart;
        $self['failedBeforeStart'] = $failedBeforeStart;
        $self['sampleViews'] = $sampleViews;
        $self['started'] = $started;
        $self['unknown'] = $unknown;

        return $self;
    }

    /**
     * View count and fraction of its documented denominator. The ratio is null when that denominator is zero.
     *
     * @param MetricCountRatio|MetricCountRatioShape $endedBeforeStart
     */
    public function withEndedBeforeStart(
        MetricCountRatio|array $endedBeforeStart
    ): self {
        $self = clone $this;
        $self['endedBeforeStart'] = $endedBeforeStart;

        return $self;
    }

    /**
     * View count and fraction of its documented denominator. The ratio is null when that denominator is zero.
     *
     * @param MetricCountRatio|MetricCountRatioShape $failedBeforeStart
     */
    public function withFailedBeforeStart(
        MetricCountRatio|array $failedBeforeStart
    ): self {
        $self = clone $this;
        $self['failedBeforeStart'] = $failedBeforeStart;

        return $self;
    }

    public function withSampleViews(int $sampleViews): self
    {
        $self = clone $this;
        $self['sampleViews'] = $sampleViews;

        return $self;
    }

    /**
     * View count and fraction of its documented denominator. The ratio is null when that denominator is zero.
     *
     * @param MetricCountRatio|MetricCountRatioShape $started
     */
    public function withStarted(MetricCountRatio|array $started): self
    {
        $self = clone $this;
        $self['started'] = $started;

        return $self;
    }

    /**
     * View count and fraction of its documented denominator. The ratio is null when that denominator is zero.
     *
     * @param MetricCountRatio|MetricCountRatioShape $unknown
     */
    public function withUnknown(MetricCountRatio|array $unknown): self
    {
        $self = clone $this;
        $self['unknown'] = $unknown;

        return $self;
    }
}
