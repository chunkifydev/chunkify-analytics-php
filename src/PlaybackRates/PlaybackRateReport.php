<?php

declare(strict_types=1);

namespace ChunkifyAnalytics\PlaybackRates;

use ChunkifyAnalytics\Core\Attributes\Required;
use ChunkifyAnalytics\Core\Concerns\SdkModel;
use ChunkifyAnalytics\Core\Contracts\BaseModel;

/**
 * @phpstan-import-type PlaybackRateMetricShape from \ChunkifyAnalytics\PlaybackRates\PlaybackRateMetric
 *
 * @phpstan-type PlaybackRateReportShape = array{
 *   rates: list<PlaybackRateMetric|PlaybackRateMetricShape>,
 *   sampleViews: int,
 *   totalPlayingTimeMs: float,
 *   totalRates: int,
 *   views: int,
 * }
 */
final class PlaybackRateReport implements BaseModel
{
    /** @use SdkModel<PlaybackRateReportShape> */
    use SdkModel;

    /**
     * Most-watched first, then value ascending with null first. Defaults to 100 rows, maximum 1000. CSV exports include all matching rows.
     *
     * @var list<PlaybackRateMetric> $rates
     */
    #[Required(list: PlaybackRateMetric::class)]
    public array $rates;

    /**
     * Attempts with positive measured playing time in this report. Older SDKs send no measurement.
     */
    #[Required('sample_views')]
    public int $sampleViews;

    /**
     * Total measured playing time across all matching rows.
     */
    #[Required('total_playing_time_ms')]
    public float $totalPlayingTimeMs;

    /**
     * Number of distinct values before applying the row limit.
     */
    #[Required('total_rates')]
    public int $totalRates;

    /**
     * All attempts in the filtered start cohort.
     */
    #[Required]
    public int $views;

    /**
     * `new PlaybackRateReport()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * PlaybackRateReport::with(
     *   rates: ...,
     *   sampleViews: ...,
     *   totalPlayingTimeMs: ...,
     *   totalRates: ...,
     *   views: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new PlaybackRateReport)
     *   ->withRates(...)
     *   ->withSampleViews(...)
     *   ->withTotalPlayingTimeMs(...)
     *   ->withTotalRates(...)
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
     *
     * @param list<PlaybackRateMetric|PlaybackRateMetricShape> $rates
     */
    public static function with(
        array $rates,
        int $sampleViews,
        float $totalPlayingTimeMs,
        int $totalRates,
        int $views,
    ): self {
        $self = new self;

        $self['rates'] = $rates;
        $self['sampleViews'] = $sampleViews;
        $self['totalPlayingTimeMs'] = $totalPlayingTimeMs;
        $self['totalRates'] = $totalRates;
        $self['views'] = $views;

        return $self;
    }

    /**
     * Most-watched first, then value ascending with null first. Defaults to 100 rows, maximum 1000. CSV exports include all matching rows.
     *
     * @param list<PlaybackRateMetric|PlaybackRateMetricShape> $rates
     */
    public function withRates(array $rates): self
    {
        $self = clone $this;
        $self['rates'] = $rates;

        return $self;
    }

    /**
     * Attempts with positive measured playing time in this report. Older SDKs send no measurement.
     */
    public function withSampleViews(int $sampleViews): self
    {
        $self = clone $this;
        $self['sampleViews'] = $sampleViews;

        return $self;
    }

    /**
     * Total measured playing time across all matching rows.
     */
    public function withTotalPlayingTimeMs(float $totalPlayingTimeMs): self
    {
        $self = clone $this;
        $self['totalPlayingTimeMs'] = $totalPlayingTimeMs;

        return $self;
    }

    /**
     * Number of distinct values before applying the row limit.
     */
    public function withTotalRates(int $totalRates): self
    {
        $self = clone $this;
        $self['totalRates'] = $totalRates;

        return $self;
    }

    /**
     * All attempts in the filtered start cohort.
     */
    public function withViews(int $views): self
    {
        $self = clone $this;
        $self['views'] = $views;

        return $self;
    }
}
