<?php

declare(strict_types=1);

namespace ChunkifyAnalytics\Views;

use ChunkifyAnalytics\Core\Attributes\Required;
use ChunkifyAnalytics\Core\Concerns\SdkModel;
use ChunkifyAnalytics\Core\Contracts\BaseModel;
use ChunkifyAnalytics\PlaybackScore;

/**
 * @phpstan-import-type PlaybackScoreShape from \ChunkifyAnalytics\PlaybackScore
 *
 * @phpstan-type ViewShape = array{
 *   browserName: string|null,
 *   deviceType: string|null,
 *   hasEndedEvent: bool,
 *   hasFatalError: bool,
 *   osName: string|null,
 *   playbackScore: PlaybackScore|PlaybackScoreShape,
 *   playingTimeMs: float,
 *   reachedEnd: bool,
 *   rebufferDurationMs: float|null,
 *   startedAt: \DateTimeInterface,
 *   startupTimeMs: float|null,
 *   userID: string|null,
 *   videoID: string,
 *   videoTitle: string|null,
 *   viewID: string,
 *   viewerID: string|null,
 * }
 */
final class View implements BaseModel
{
    /** @use SdkModel<ViewShape> */
    use SdkModel;

    #[Required('browser_name')]
    public ?string $browserName;

    #[Required('device_type')]
    public ?string $deviceType;

    #[Required('has_ended_event')]
    public bool $hasEndedEvent;

    #[Required('has_fatal_error')]
    public bool $hasFatalError;

    #[Required('os_name')]
    public ?string $osName;

    #[Required('playback_score')]
    public PlaybackScore $playbackScore;

    #[Required('playing_time_ms')]
    public float $playingTimeMs;

    #[Required('reached_end')]
    public bool $reachedEnd;

    #[Required('rebuffer_duration_ms')]
    public ?float $rebufferDurationMs;

    #[Required('started_at')]
    public \DateTimeInterface $startedAt;

    #[Required('startup_time_ms')]
    public ?float $startupTimeMs;

    #[Required('user_id')]
    public ?string $userID;

    #[Required('video_id')]
    public string $videoID;

    #[Required('video_title')]
    public ?string $videoTitle;

    #[Required('view_id')]
    public string $viewID;

    #[Required('viewer_id')]
    public ?string $viewerID;

    /**
     * `new View()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * View::with(
     *   browserName: ...,
     *   deviceType: ...,
     *   hasEndedEvent: ...,
     *   hasFatalError: ...,
     *   osName: ...,
     *   playbackScore: ...,
     *   playingTimeMs: ...,
     *   reachedEnd: ...,
     *   rebufferDurationMs: ...,
     *   startedAt: ...,
     *   startupTimeMs: ...,
     *   userID: ...,
     *   videoID: ...,
     *   videoTitle: ...,
     *   viewID: ...,
     *   viewerID: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new View)
     *   ->withBrowserName(...)
     *   ->withDeviceType(...)
     *   ->withHasEndedEvent(...)
     *   ->withHasFatalError(...)
     *   ->withOsName(...)
     *   ->withPlaybackScore(...)
     *   ->withPlayingTimeMs(...)
     *   ->withReachedEnd(...)
     *   ->withRebufferDurationMs(...)
     *   ->withStartedAt(...)
     *   ->withStartupTimeMs(...)
     *   ->withUserID(...)
     *   ->withVideoID(...)
     *   ->withVideoTitle(...)
     *   ->withViewID(...)
     *   ->withViewerID(...)
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
        ?string $browserName,
        ?string $deviceType,
        bool $hasEndedEvent,
        bool $hasFatalError,
        ?string $osName,
        PlaybackScore|array $playbackScore,
        float $playingTimeMs,
        bool $reachedEnd,
        ?float $rebufferDurationMs,
        \DateTimeInterface $startedAt,
        ?float $startupTimeMs,
        ?string $userID,
        string $videoID,
        ?string $videoTitle,
        string $viewID,
        ?string $viewerID,
    ): self {
        $self = new self;

        $self['browserName'] = $browserName;
        $self['deviceType'] = $deviceType;
        $self['hasEndedEvent'] = $hasEndedEvent;
        $self['hasFatalError'] = $hasFatalError;
        $self['osName'] = $osName;
        $self['playbackScore'] = $playbackScore;
        $self['playingTimeMs'] = $playingTimeMs;
        $self['reachedEnd'] = $reachedEnd;
        $self['rebufferDurationMs'] = $rebufferDurationMs;
        $self['startedAt'] = $startedAt;
        $self['startupTimeMs'] = $startupTimeMs;
        $self['userID'] = $userID;
        $self['videoID'] = $videoID;
        $self['videoTitle'] = $videoTitle;
        $self['viewID'] = $viewID;
        $self['viewerID'] = $viewerID;

        return $self;
    }

    public function withBrowserName(?string $browserName): self
    {
        $self = clone $this;
        $self['browserName'] = $browserName;

        return $self;
    }

    public function withDeviceType(?string $deviceType): self
    {
        $self = clone $this;
        $self['deviceType'] = $deviceType;

        return $self;
    }

    public function withHasEndedEvent(bool $hasEndedEvent): self
    {
        $self = clone $this;
        $self['hasEndedEvent'] = $hasEndedEvent;

        return $self;
    }

    public function withHasFatalError(bool $hasFatalError): self
    {
        $self = clone $this;
        $self['hasFatalError'] = $hasFatalError;

        return $self;
    }

    public function withOsName(?string $osName): self
    {
        $self = clone $this;
        $self['osName'] = $osName;

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

    public function withPlayingTimeMs(float $playingTimeMs): self
    {
        $self = clone $this;
        $self['playingTimeMs'] = $playingTimeMs;

        return $self;
    }

    public function withReachedEnd(bool $reachedEnd): self
    {
        $self = clone $this;
        $self['reachedEnd'] = $reachedEnd;

        return $self;
    }

    public function withRebufferDurationMs(?float $rebufferDurationMs): self
    {
        $self = clone $this;
        $self['rebufferDurationMs'] = $rebufferDurationMs;

        return $self;
    }

    public function withStartedAt(\DateTimeInterface $startedAt): self
    {
        $self = clone $this;
        $self['startedAt'] = $startedAt;

        return $self;
    }

    public function withStartupTimeMs(?float $startupTimeMs): self
    {
        $self = clone $this;
        $self['startupTimeMs'] = $startupTimeMs;

        return $self;
    }

    public function withUserID(?string $userID): self
    {
        $self = clone $this;
        $self['userID'] = $userID;

        return $self;
    }

    public function withVideoID(string $videoID): self
    {
        $self = clone $this;
        $self['videoID'] = $videoID;

        return $self;
    }

    public function withVideoTitle(?string $videoTitle): self
    {
        $self = clone $this;
        $self['videoTitle'] = $videoTitle;

        return $self;
    }

    public function withViewID(string $viewID): self
    {
        $self = clone $this;
        $self['viewID'] = $viewID;

        return $self;
    }

    public function withViewerID(?string $viewerID): self
    {
        $self = clone $this;
        $self['viewerID'] = $viewerID;

        return $self;
    }
}
