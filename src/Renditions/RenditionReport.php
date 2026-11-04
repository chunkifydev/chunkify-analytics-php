<?php

declare(strict_types=1);

namespace ChunkifyAnalytics\Renditions;

use ChunkifyAnalytics\Core\Attributes\Required;
use ChunkifyAnalytics\Core\Concerns\SdkModel;
use ChunkifyAnalytics\Core\Contracts\BaseModel;

/**
 * @phpstan-import-type RenditionMetricShape from \ChunkifyAnalytics\Renditions\RenditionMetric
 *
 * @phpstan-type RenditionReportShape = array{
 *   averageBitrateBps: float|null,
 *   bitrateSamplePlayingTimeMs: float,
 *   renditions: list<RenditionMetric|RenditionMetricShape>,
 *   sampleViews: int,
 *   totalPlayingTimeMs: float,
 *   totalRenditions: int,
 *   views: int,
 * }
 */
final class RenditionReport implements BaseModel
{
    /** @use SdkModel<RenditionReportShape> */
    use SdkModel;

    /**
     * Time-weighted mean declared bitrate. Null without playing time with a known bitrate.
     */
    #[Required('average_bitrate_bps')]
    public ?float $averageBitrateBps;

    /**
     * Measured playing time with a known rendition bitrate, used as the average denominator.
     */
    #[Required('bitrate_sample_playing_time_ms')]
    public float $bitrateSamplePlayingTimeMs;

    /**
     * Most-played renditions first. Defaults to 100 rows, maximum 1000. CSV exports include all matching rows.
     *
     * @var list<RenditionMetric> $renditions
     */
    #[Required(list: RenditionMetric::class)]
    public array $renditions;

    /**
     * Attempts with positive measured rendition playing time.
     */
    #[Required('sample_views')]
    public int $sampleViews;

    /**
     * Total measured rendition playing time across all matching rows. Can be less than overall watch time when rendition information is missing.
     */
    #[Required('total_playing_time_ms')]
    public float $totalPlayingTimeMs;

    /**
     * Number of distinct renditions before applying the row limit.
     */
    #[Required('total_renditions')]
    public int $totalRenditions;

    /**
     * All attempts in the filtered start cohort.
     */
    #[Required]
    public int $views;

    /**
     * `new RenditionReport()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * RenditionReport::with(
     *   averageBitrateBps: ...,
     *   bitrateSamplePlayingTimeMs: ...,
     *   renditions: ...,
     *   sampleViews: ...,
     *   totalPlayingTimeMs: ...,
     *   totalRenditions: ...,
     *   views: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new RenditionReport)
     *   ->withAverageBitrateBps(...)
     *   ->withBitrateSamplePlayingTimeMs(...)
     *   ->withRenditions(...)
     *   ->withSampleViews(...)
     *   ->withTotalPlayingTimeMs(...)
     *   ->withTotalRenditions(...)
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
     * @param list<RenditionMetric|RenditionMetricShape> $renditions
     */
    public static function with(
        ?float $averageBitrateBps,
        float $bitrateSamplePlayingTimeMs,
        array $renditions,
        int $sampleViews,
        float $totalPlayingTimeMs,
        int $totalRenditions,
        int $views,
    ): self {
        $self = new self;

        $self['averageBitrateBps'] = $averageBitrateBps;
        $self['bitrateSamplePlayingTimeMs'] = $bitrateSamplePlayingTimeMs;
        $self['renditions'] = $renditions;
        $self['sampleViews'] = $sampleViews;
        $self['totalPlayingTimeMs'] = $totalPlayingTimeMs;
        $self['totalRenditions'] = $totalRenditions;
        $self['views'] = $views;

        return $self;
    }

    /**
     * Time-weighted mean declared bitrate. Null without playing time with a known bitrate.
     */
    public function withAverageBitrateBps(?float $averageBitrateBps): self
    {
        $self = clone $this;
        $self['averageBitrateBps'] = $averageBitrateBps;

        return $self;
    }

    /**
     * Measured playing time with a known rendition bitrate, used as the average denominator.
     */
    public function withBitrateSamplePlayingTimeMs(
        float $bitrateSamplePlayingTimeMs
    ): self {
        $self = clone $this;
        $self['bitrateSamplePlayingTimeMs'] = $bitrateSamplePlayingTimeMs;

        return $self;
    }

    /**
     * Most-played renditions first. Defaults to 100 rows, maximum 1000. CSV exports include all matching rows.
     *
     * @param list<RenditionMetric|RenditionMetricShape> $renditions
     */
    public function withRenditions(array $renditions): self
    {
        $self = clone $this;
        $self['renditions'] = $renditions;

        return $self;
    }

    /**
     * Attempts with positive measured rendition playing time.
     */
    public function withSampleViews(int $sampleViews): self
    {
        $self = clone $this;
        $self['sampleViews'] = $sampleViews;

        return $self;
    }

    /**
     * Total measured rendition playing time across all matching rows. Can be less than overall watch time when rendition information is missing.
     */
    public function withTotalPlayingTimeMs(float $totalPlayingTimeMs): self
    {
        $self = clone $this;
        $self['totalPlayingTimeMs'] = $totalPlayingTimeMs;

        return $self;
    }

    /**
     * Number of distinct renditions before applying the row limit.
     */
    public function withTotalRenditions(int $totalRenditions): self
    {
        $self = clone $this;
        $self['totalRenditions'] = $totalRenditions;

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
