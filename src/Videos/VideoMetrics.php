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
        int $views,
    ): self {
        $self = new self;

        $self['playbackScore'] = $playbackScore;
        $self['totalPlayingTimeMs'] = $totalPlayingTimeMs;
        $self['uniqueViewers'] = $uniqueViewers;
        $self['videoID'] = $videoID;
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

    public function withViews(int $views): self
    {
        $self = clone $this;
        $self['views'] = $views;

        return $self;
    }
}
