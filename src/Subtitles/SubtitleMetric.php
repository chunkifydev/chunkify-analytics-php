<?php

declare(strict_types=1);

namespace ChunkifyAnalytics\Subtitles;

use ChunkifyAnalytics\Core\Attributes\Required;
use ChunkifyAnalytics\Core\Concerns\SdkModel;
use ChunkifyAnalytics\Core\Contracts\BaseModel;

/**
 * Watch time with one subtitle language, or with subtitles off.
 *
 * @phpstan-type SubtitleMetricShape = array{
 *   language: string|null,
 *   playingTimeMs: float,
 *   playingTimeRatio: float,
 *   views: int,
 * }
 */
final class SubtitleMetric implements BaseModel
{
    /** @use SdkModel<SubtitleMetricShape> */
    use SdkModel;

    /**
     * Subtitle language tag; und for a track without a language; null for subtitles off.
     */
    #[Required]
    public ?string $language;

    /**
     * Cumulative measured playing time in this language, summed once per attempt.
     */
    #[Required('playing_time_ms')]
    public float $playingTimeMs;

    /**
     * Share of all measured playing time, including rows outside the returned limit.
     */
    #[Required('playing_time_ratio')]
    public float $playingTimeRatio;

    /**
     * Distinct attempts with positive playing time in this language.
     */
    #[Required]
    public int $views;

    /**
     * `new SubtitleMetric()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * SubtitleMetric::with(
     *   language: ..., playingTimeMs: ..., playingTimeRatio: ..., views: ...
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new SubtitleMetric)
     *   ->withLanguage(...)
     *   ->withPlayingTimeMs(...)
     *   ->withPlayingTimeRatio(...)
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
        ?string $language,
        float $playingTimeMs,
        float $playingTimeRatio,
        int $views
    ): self {
        $self = new self;

        $self['language'] = $language;
        $self['playingTimeMs'] = $playingTimeMs;
        $self['playingTimeRatio'] = $playingTimeRatio;
        $self['views'] = $views;

        return $self;
    }

    /**
     * Subtitle language tag; und for a track without a language; null for subtitles off.
     */
    public function withLanguage(?string $language): self
    {
        $self = clone $this;
        $self['language'] = $language;

        return $self;
    }

    /**
     * Cumulative measured playing time in this language, summed once per attempt.
     */
    public function withPlayingTimeMs(float $playingTimeMs): self
    {
        $self = clone $this;
        $self['playingTimeMs'] = $playingTimeMs;

        return $self;
    }

    /**
     * Share of all measured playing time, including rows outside the returned limit.
     */
    public function withPlayingTimeRatio(float $playingTimeRatio): self
    {
        $self = clone $this;
        $self['playingTimeRatio'] = $playingTimeRatio;

        return $self;
    }

    /**
     * Distinct attempts with positive playing time in this language.
     */
    public function withViews(int $views): self
    {
        $self = clone $this;
        $self['views'] = $views;

        return $self;
    }
}
