<?php

declare(strict_types=1);

namespace ChunkifyAnalytics\Quality;

use ChunkifyAnalytics\Core\Attributes\Required;
use ChunkifyAnalytics\Core\Concerns\SdkModel;
use ChunkifyAnalytics\Core\Contracts\BaseModel;
use ChunkifyAnalytics\PlaybackScore;
use ChunkifyAnalytics\Quality\Quality\Buffering;
use ChunkifyAnalytics\Quality\Quality\FatalErrors;
use ChunkifyAnalytics\Quality\Quality\StartupTimeMs;
use ChunkifyAnalytics\StartupOutcomes;

/**
 * Playback quality for the same start cohort as summary. All rates are fractions. Counts expose measurement coverage.
 *
 * @phpstan-import-type BufferingShape from \ChunkifyAnalytics\Quality\Quality\Buffering
 * @phpstan-import-type FatalErrorsShape from \ChunkifyAnalytics\Quality\Quality\FatalErrors
 * @phpstan-import-type PlaybackScoreShape from \ChunkifyAnalytics\PlaybackScore
 * @phpstan-import-type StartupOutcomesShape from \ChunkifyAnalytics\StartupOutcomes
 * @phpstan-import-type StartupTimeMsShape from \ChunkifyAnalytics\Quality\Quality\StartupTimeMs
 *
 * @phpstan-type QualityShape = array{
 *   buffering: Buffering|BufferingShape,
 *   fatalErrors: FatalErrors|FatalErrorsShape,
 *   playbackScore: PlaybackScore|PlaybackScoreShape,
 *   startupOutcomes: StartupOutcomes|StartupOutcomesShape,
 *   startupTimeMs: StartupTimeMs|StartupTimeMsShape,
 *   views: int,
 * }
 */
final class Quality implements BaseModel
{
    /** @use SdkModel<QualityShape> */
    use SdkModel;

    /**
     * Duration-weighted buffering. Startup wait, pauses and seeking are excluded by the SDK. Unknown durations are not treated as zero.
     */
    #[Required]
    public Buffering $buffering;

    /**
     * Observed fatal errors. Lost events can undercount this metric; absence of an error is not proof of successful playback.
     */
    #[Required('fatal_errors')]
    public FatalErrors $fatalErrors;

    #[Required('playback_score')]
    public PlaybackScore $playbackScore;

    /**
     * Mutually exclusive outcomes. An explicit startup_outcome on the selected final event takes precedence. Otherwise an available startup time, including zero, or positive playing time on the selected measurement proves started. All other views are unknown. sample_views excludes unknown; every ratio uses all selected attempts, including unknown. Missing final delivery does not prove an exit or failure.
     */
    #[Required('startup_outcomes')]
    public StartupOutcomes $startupOutcomes;

    /**
     * Time from attempt to first playing, measured once per eligible view. This is not first-frame timing.
     */
    #[Required('startup_time_ms')]
    public StartupTimeMs $startupTimeMs;

    /**
     * Selected playback attempts with a retained start, including failed attempts.
     */
    #[Required]
    public int $views;

    /**
     * `new Quality()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Quality::with(
     *   buffering: ...,
     *   fatalErrors: ...,
     *   playbackScore: ...,
     *   startupOutcomes: ...,
     *   startupTimeMs: ...,
     *   views: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Quality)
     *   ->withBuffering(...)
     *   ->withFatalErrors(...)
     *   ->withPlaybackScore(...)
     *   ->withStartupOutcomes(...)
     *   ->withStartupTimeMs(...)
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
     * @param Buffering|BufferingShape $buffering
     * @param FatalErrors|FatalErrorsShape $fatalErrors
     * @param PlaybackScore|PlaybackScoreShape $playbackScore
     * @param StartupOutcomes|StartupOutcomesShape $startupOutcomes
     * @param StartupTimeMs|StartupTimeMsShape $startupTimeMs
     */
    public static function with(
        Buffering|array $buffering,
        FatalErrors|array $fatalErrors,
        PlaybackScore|array $playbackScore,
        StartupOutcomes|array $startupOutcomes,
        StartupTimeMs|array $startupTimeMs,
        int $views,
    ): self {
        $self = new self;

        $self['buffering'] = $buffering;
        $self['fatalErrors'] = $fatalErrors;
        $self['playbackScore'] = $playbackScore;
        $self['startupOutcomes'] = $startupOutcomes;
        $self['startupTimeMs'] = $startupTimeMs;
        $self['views'] = $views;

        return $self;
    }

    /**
     * Duration-weighted buffering. Startup wait, pauses and seeking are excluded by the SDK. Unknown durations are not treated as zero.
     *
     * @param Buffering|BufferingShape $buffering
     */
    public function withBuffering(Buffering|array $buffering): self
    {
        $self = clone $this;
        $self['buffering'] = $buffering;

        return $self;
    }

    /**
     * Observed fatal errors. Lost events can undercount this metric; absence of an error is not proof of successful playback.
     *
     * @param FatalErrors|FatalErrorsShape $fatalErrors
     */
    public function withFatalErrors(FatalErrors|array $fatalErrors): self
    {
        $self = clone $this;
        $self['fatalErrors'] = $fatalErrors;

        return $self;
    }

    /**
     * @param PlaybackScore|PlaybackScoreShape $playbackScore
     */
    public function withPlaybackScore(PlaybackScore|array $playbackScore): self
    {
        $self = clone $this;
        $self['playbackScore'] = $playbackScore;

        return $self;
    }

    /**
     * Mutually exclusive outcomes. An explicit startup_outcome on the selected final event takes precedence. Otherwise an available startup time, including zero, or positive playing time on the selected measurement proves started. All other views are unknown. sample_views excludes unknown; every ratio uses all selected attempts, including unknown. Missing final delivery does not prove an exit or failure.
     *
     * @param StartupOutcomes|StartupOutcomesShape $startupOutcomes
     */
    public function withStartupOutcomes(
        StartupOutcomes|array $startupOutcomes
    ): self {
        $self = clone $this;
        $self['startupOutcomes'] = $startupOutcomes;

        return $self;
    }

    /**
     * Time from attempt to first playing, measured once per eligible view. This is not first-frame timing.
     *
     * @param StartupTimeMs|StartupTimeMsShape $startupTimeMs
     */
    public function withStartupTimeMs(StartupTimeMs|array $startupTimeMs): self
    {
        $self = clone $this;
        $self['startupTimeMs'] = $startupTimeMs;

        return $self;
    }

    /**
     * Selected playback attempts with a retained start, including failed attempts.
     */
    public function withViews(int $views): self
    {
        $self = clone $this;
        $self['views'] = $views;

        return $self;
    }
}
