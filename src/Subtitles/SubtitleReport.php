<?php

declare(strict_types=1);

namespace ChunkifyAnalytics\Subtitles;

use ChunkifyAnalytics\Core\Attributes\Required;
use ChunkifyAnalytics\Core\Concerns\SdkModel;
use ChunkifyAnalytics\Core\Contracts\BaseModel;

/**
 * @phpstan-import-type SubtitleMetricShape from \ChunkifyAnalytics\Subtitles\SubtitleMetric
 *
 * @phpstan-type SubtitleReportShape = array{
 *   languages: list<SubtitleMetric|SubtitleMetricShape>,
 *   sampleViews: int,
 *   totalLanguages: int,
 *   totalPlayingTimeMs: float,
 *   views: int,
 * }
 */
final class SubtitleReport implements BaseModel
{
    /** @use SdkModel<SubtitleReportShape> */
    use SdkModel;

    /**
     * Most-watched first, then value ascending with null first. Defaults to 100 rows, maximum 1000. CSV exports include all matching rows.
     *
     * @var list<SubtitleMetric> $languages
     */
    #[Required(list: SubtitleMetric::class)]
    public array $languages;

    /**
     * Attempts with positive measured playing time in this report. Older SDKs send no measurement.
     */
    #[Required('sample_views')]
    public int $sampleViews;

    /**
     * Number of distinct values before applying the row limit.
     */
    #[Required('total_languages')]
    public int $totalLanguages;

    /**
     * Total measured playing time across all matching rows.
     */
    #[Required('total_playing_time_ms')]
    public float $totalPlayingTimeMs;

    /**
     * All attempts in the filtered start cohort.
     */
    #[Required]
    public int $views;

    /**
     * `new SubtitleReport()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * SubtitleReport::with(
     *   languages: ...,
     *   sampleViews: ...,
     *   totalLanguages: ...,
     *   totalPlayingTimeMs: ...,
     *   views: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new SubtitleReport)
     *   ->withLanguages(...)
     *   ->withSampleViews(...)
     *   ->withTotalLanguages(...)
     *   ->withTotalPlayingTimeMs(...)
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
     * @param list<SubtitleMetric|SubtitleMetricShape> $languages
     */
    public static function with(
        array $languages,
        int $sampleViews,
        int $totalLanguages,
        float $totalPlayingTimeMs,
        int $views,
    ): self {
        $self = new self;

        $self['languages'] = $languages;
        $self['sampleViews'] = $sampleViews;
        $self['totalLanguages'] = $totalLanguages;
        $self['totalPlayingTimeMs'] = $totalPlayingTimeMs;
        $self['views'] = $views;

        return $self;
    }

    /**
     * Most-watched first, then value ascending with null first. Defaults to 100 rows, maximum 1000. CSV exports include all matching rows.
     *
     * @param list<SubtitleMetric|SubtitleMetricShape> $languages
     */
    public function withLanguages(array $languages): self
    {
        $self = clone $this;
        $self['languages'] = $languages;

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
     * Number of distinct values before applying the row limit.
     */
    public function withTotalLanguages(int $totalLanguages): self
    {
        $self = clone $this;
        $self['totalLanguages'] = $totalLanguages;

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
     * All attempts in the filtered start cohort.
     */
    public function withViews(int $views): self
    {
        $self = clone $this;
        $self['views'] = $views;

        return $self;
    }
}
