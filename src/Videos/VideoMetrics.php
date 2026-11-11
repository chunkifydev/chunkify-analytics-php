<?php

declare(strict_types=1);

namespace ChunkifyAnalytics\Videos;

use ChunkifyAnalytics\Core\Attributes\Required;
use ChunkifyAnalytics\Core\Concerns\SdkModel;
use ChunkifyAnalytics\Core\Contracts\BaseModel;
use ChunkifyAnalytics\PlaybackScore;

/**
 * @phpstan-import-type PlaybackScoreShape from \ChunkifyAnalytics\PlaybackScore
 *
 * @phpstan-type VideoMetricsShape = array{
 *   playbackScore: PlaybackScore|PlaybackScoreShape,
 *   totalPlayingTimeMs: float,
 *   uniqueViewers: int,
 *   videoID: string,
 *   videoTitle: string|null,
 *   views: int,
 * }
 */
final class VideoMetrics implements BaseModel
{
    /** @use SdkModel<VideoMetricsShape> */
    use SdkModel;

    #[Required('playback_score')]
    public PlaybackScore $playbackScore;

    #[Required('total_playing_time_ms')]
    public float $totalPlayingTimeMs;

    #[Required('unique_viewers')]
    public int $uniqueViewers;

    #[Required('video_id')]
    public string $videoID;

    /**
     * Title from the most recently received selected start that supplied one.
     */
    #[Required('video_title')]
    public ?string $videoTitle;

    #[Required]
    public int $views;

    /**
     * `new VideoMetrics()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * VideoMetrics::with(
     *   playbackScore: ...,
     *   totalPlayingTimeMs: ...,
     *   uniqueViewers: ...,
     *   videoID: ...,
     *   videoTitle: ...,
     *   views: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new VideoMetrics)
     *   ->withPlaybackScore(...)
     *   ->withTotalPlayingTimeMs(...)
     *   ->withUniqueViewers(...)
     *   ->withVideoID(...)
     *   ->withVideoTitle(...)
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
     * @param PlaybackScore|PlaybackScoreShape $playbackScore
     */
    public static function with(
        PlaybackScore|array $playbackScore,
        float $totalPlayingTimeMs,
        int $uniqueViewers,
        string $videoID,
        ?string $videoTitle,
        int $views,
    ): self {
        $self = new self;

        $self['playbackScore'] = $playbackScore;
        $self['totalPlayingTimeMs'] = $totalPlayingTimeMs;
        $self['uniqueViewers'] = $uniqueViewers;
        $self['videoID'] = $videoID;
        $self['videoTitle'] = $videoTitle;
        $self['views'] = $views;

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

    public function withVideoID(string $videoID): self
    {
        $self = clone $this;
        $self['videoID'] = $videoID;

        return $self;
    }

    /**
     * Title from the most recently received selected start that supplied one.
     */
    public function withVideoTitle(?string $videoTitle): self
    {
        $self = clone $this;
        $self['videoTitle'] = $videoTitle;

        return $self;
    }

    public function withViews(int $views): self
    {
        $self = clone $this;
        $self['views'] = $views;

        return $self;
    }
}
