<?php

declare(strict_types=1);

namespace ChunkifyAnalytics;

use ChunkifyAnalytics\Core\Attributes\Required;
use ChunkifyAnalytics\Core\Concerns\SdkModel;
use ChunkifyAnalytics\Core\Contracts\BaseModel;

/**
 * Furthest progress on the selected final event or latest snapshot. Only views with a positive known media duration and a progress ratio in [0,1] are samples. Each milestone ratio uses sample_views. Seeking can count; this is not watched coverage or audience retention.
 *
 * @phpstan-import-type MetricCountRatioShape from \ChunkifyAnalytics\MetricCountRatio
 *
 * @phpstan-type ProgressReachedShape = array{
 *   at100Percent: MetricCountRatio|MetricCountRatioShape,
 *   at25Percent: MetricCountRatio|MetricCountRatioShape,
 *   at50Percent: MetricCountRatio|MetricCountRatioShape,
 *   at75Percent: MetricCountRatio|MetricCountRatioShape,
 *   sampleViews: int,
 * }
 */
final class ProgressReached implements BaseModel
{
    /** @use SdkModel<ProgressReachedShape> */
    use SdkModel;

    /**
     * View count and fraction of its documented denominator. The ratio is null when that denominator is zero.
     */
    #[Required('at_100_percent')]
    public MetricCountRatio $at100Percent;

    /**
     * View count and fraction of its documented denominator. The ratio is null when that denominator is zero.
     */
    #[Required('at_25_percent')]
    public MetricCountRatio $at25Percent;

    /**
     * View count and fraction of its documented denominator. The ratio is null when that denominator is zero.
     */
    #[Required('at_50_percent')]
    public MetricCountRatio $at50Percent;

    /**
     * View count and fraction of its documented denominator. The ratio is null when that denominator is zero.
     */
    #[Required('at_75_percent')]
    public MetricCountRatio $at75Percent;

    #[Required('sample_views')]
    public int $sampleViews;

    /**
     * `new ProgressReached()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ProgressReached::with(
     *   at100Percent: ...,
     *   at25Percent: ...,
     *   at50Percent: ...,
     *   at75Percent: ...,
     *   sampleViews: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ProgressReached)
     *   ->withAt100Percent(...)
     *   ->withAt25Percent(...)
     *   ->withAt50Percent(...)
     *   ->withAt75Percent(...)
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
     * @param MetricCountRatio|MetricCountRatioShape $at100Percent
     * @param MetricCountRatio|MetricCountRatioShape $at25Percent
     * @param MetricCountRatio|MetricCountRatioShape $at50Percent
     * @param MetricCountRatio|MetricCountRatioShape $at75Percent
     */
    public static function with(
        MetricCountRatio|array $at100Percent,
        MetricCountRatio|array $at25Percent,
        MetricCountRatio|array $at50Percent,
        MetricCountRatio|array $at75Percent,
        int $sampleViews,
    ): self {
        $self = new self;

        $self['at100Percent'] = $at100Percent;
        $self['at25Percent'] = $at25Percent;
        $self['at50Percent'] = $at50Percent;
        $self['at75Percent'] = $at75Percent;
        $self['sampleViews'] = $sampleViews;

        return $self;
    }

    /**
     * View count and fraction of its documented denominator. The ratio is null when that denominator is zero.
     *
     * @param MetricCountRatio|MetricCountRatioShape $at100Percent
     */
    public function withAt100Percent(MetricCountRatio|array $at100Percent): self
    {
        $self = clone $this;
        $self['at100Percent'] = $at100Percent;

        return $self;
    }

    /**
     * View count and fraction of its documented denominator. The ratio is null when that denominator is zero.
     *
     * @param MetricCountRatio|MetricCountRatioShape $at25Percent
     */
    public function withAt25Percent(MetricCountRatio|array $at25Percent): self
    {
        $self = clone $this;
        $self['at25Percent'] = $at25Percent;

        return $self;
    }

    /**
     * View count and fraction of its documented denominator. The ratio is null when that denominator is zero.
     *
     * @param MetricCountRatio|MetricCountRatioShape $at50Percent
     */
    public function withAt50Percent(MetricCountRatio|array $at50Percent): self
    {
        $self = clone $this;
        $self['at50Percent'] = $at50Percent;

        return $self;
    }

    /**
     * View count and fraction of its documented denominator. The ratio is null when that denominator is zero.
     *
     * @param MetricCountRatio|MetricCountRatioShape $at75Percent
     */
    public function withAt75Percent(MetricCountRatio|array $at75Percent): self
    {
        $self = clone $this;
        $self['at75Percent'] = $at75Percent;

        return $self;
    }

    public function withSampleViews(int $sampleViews): self
    {
        $self = clone $this;
        $self['sampleViews'] = $sampleViews;

        return $self;
    }
}
