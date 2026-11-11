<?php

declare(strict_types=1);

namespace ChunkifyAnalytics\Events;

use ChunkifyAnalytics\Core\Attributes\Optional;
use ChunkifyAnalytics\Core\Attributes\Required;
use ChunkifyAnalytics\Core\Concerns\SdkModel;
use ChunkifyAnalytics\Core\Contracts\BaseModel;
use ChunkifyAnalytics\Core\Omit;
use ChunkifyAnalytics\Events\SubtitleChanged\ErrorCategory;
use ChunkifyAnalytics\Events\SubtitleChanged\Reason;
use ChunkifyAnalytics\Events\SubtitleChanged\StartupOutcome;
use ChunkifyAnalytics\Events\SubtitleChanged\VisibilityState;
use ChunkifyAnalytics\RenditionPlayingTime;

/**
 * @phpstan-import-type ErrorCodeVariants from \ChunkifyAnalytics\Events\SubtitleChanged\ErrorCode
 * @phpstan-import-type ErrorCodeShape from \ChunkifyAnalytics\Events\SubtitleChanged\ErrorCode
 * @phpstan-import-type RenditionPlayingTimeShape from \ChunkifyAnalytics\RenditionPlayingTime
 *
 * @phpstan-type SubtitleChangedShape = array{
 *   connectorName: string,
 *   connectorVersion: string|null,
 *   deliveryHostname: string|null,
 *   environment: string|null,
 *   errorCategory: null|ErrorCategory|value-of<ErrorCategory>,
 *   errorCode: ErrorCodeShape|null,
 *   errorFatal: bool|null,
 *   errorPlayheadSeconds: float|null,
 *   eventID: string,
 *   eventName: 'chunkify.video.subtitle_changed',
 *   occurredAt: \DateTimeInterface,
 *   playerName: string|null,
 *   playerVersion: string|null,
 *   playheadSeconds: float|null,
 *   previousSubtitleLanguage: string|null,
 *   reason: null|Reason|value-of<Reason>,
 *   schemaVersion: 1,
 *   sdkName: string,
 *   sdkVersion: string,
 *   sequence: int,
 *   startupOutcome: null|StartupOutcome|value-of<StartupOutcome>,
 *   subtitleLanguage: string|null,
 *   videoID: string,
 *   viewID: string,
 *   viewerID: string|null,
 *   browserContext?: mixed,
 *   deliveryRequestCount?: float|null,
 *   deliveryThroughputBps?: float|null,
 *   deliveryTransferredBytes?: float|null,
 *   droppedVideoFrames?: float|null,
 *   firstVideoFrameTimeMs?: float|null,
 *   furthestProgressRatio?: float|null,
 *   maximumPlayheadSeconds?: float|null,
 *   mediaDurationSeconds?: float|null,
 *   mediaHeightPx?: float|null,
 *   mediaWidthPx?: float|null,
 *   playerHeightPx?: float|null,
 *   playerWidthPx?: float|null,
 *   playingTimeMs?: float|null,
 *   rebufferCount?: float|null,
 *   rebufferDurationMs?: float|null,
 *   rebufferRatio?: float|null,
 *   renditionPlayingTime?: list<RenditionPlayingTime|RenditionPlayingTimeShape>|null,
 *   renditionSwitchCount?: float|null,
 *   seekCount?: float|null,
 *   seekDurationMs?: float|null,
 *   selectedRenditionBitrateBps?: float|null,
 *   selectedRenditionCodec?: string|null,
 *   selectedRenditionHeight?: float|null,
 *   selectedRenditionWidth?: float|null,
 *   startupTimeMs?: float|null,
 *   totalVideoFrames?: float|null,
 *   userID?: string|null,
 *   videoTitle?: string|null,
 *   visibilityState?: null|VisibilityState|value-of<VisibilityState>,
 * }
 */
final class SubtitleChanged implements BaseModel
{
    /** @use SdkModel<SubtitleChangedShape> */
    use SdkModel;

    /** @var 'chunkify.video.subtitle_changed' $eventName */
    #[Required('event_name')]
    public string $eventName = 'chunkify.video.subtitle_changed';

    /** @var 1 $schemaVersion */
    #[Required('schema_version')]
    public int $schemaVersion = 1;

    #[Required('connector_name')]
    public string $connectorName;

    #[Required('connector_version')]
    public ?string $connectorVersion;

    #[Required('delivery_hostname')]
    public ?string $deliveryHostname;

    #[Required]
    public ?string $environment;

    /** @var value-of<ErrorCategory>|null $errorCategory */
    #[Required('error_category', enum: ErrorCategory::class)]
    public ?string $errorCategory;

    /** @var ErrorCodeVariants|null $errorCode */
    #[Required('error_code')]
    public string|float|null $errorCode;

    #[Required('error_fatal')]
    public ?bool $errorFatal;

    #[Required('error_playhead_seconds')]
    public ?float $errorPlayheadSeconds;

    #[Required('event_id')]
    public string $eventID;

    #[Required('occurred_at')]
    public \DateTimeInterface $occurredAt;

    #[Required('player_name')]
    public ?string $playerName;

    #[Required('player_version')]
    public ?string $playerVersion;

    #[Required('playhead_seconds')]
    public ?float $playheadSeconds;

    /**
     * Language before the change; null when subtitles were off.
     */
    #[Required('previous_subtitle_language')]
    public ?string $previousSubtitleLanguage;

    /** @var value-of<Reason>|null $reason */
    #[Required(enum: Reason::class)]
    public ?string $reason;

    /**
     * Name of the SDK or integration that produced the event. Informational metadata, preserved as received. Must contain at least one non-whitespace character.
     */
    #[Required('sdk_name')]
    public string $sdkName;

    #[Required('sdk_version')]
    public string $sdkVersion;

    #[Required]
    public int $sequence;

    /** @var value-of<StartupOutcome>|null $startupOutcome */
    #[Required('startup_outcome', enum: StartupOutcome::class)]
    public ?string $startupOutcome;

    /**
     * Language after the change; null when subtitles are now off.
     */
    #[Required('subtitle_language')]
    public ?string $subtitleLanguage;

    #[Required('video_id')]
    public string $videoID;

    #[Required('view_id')]
    public string $viewID;

    /**
     * Anonymous browser identifier generated by the Chunkify player SDK and stored in the page's localStorage.
     */
    #[Required('viewer_id')]
    public ?string $viewerID;

    /**
     * Optional browser information supplied by the player.
     */
    #[Optional('browser_context')]
    public mixed $browserContext;

    #[Optional('delivery_request_count', nullable: true)]
    public ?float $deliveryRequestCount;

    #[Optional('delivery_throughput_bps', nullable: true)]
    public ?float $deliveryThroughputBps;

    #[Optional('delivery_transferred_bytes', nullable: true)]
    public ?float $deliveryTransferredBytes;

    #[Optional('dropped_video_frames', nullable: true)]
    public ?float $droppedVideoFrames;

    #[Optional('first_video_frame_time_ms', nullable: true)]
    public ?float $firstVideoFrameTimeMs;

    #[Optional('furthest_progress_ratio', nullable: true)]
    public ?float $furthestProgressRatio;

    #[Optional('maximum_playhead_seconds')]
    public ?float $maximumPlayheadSeconds;

    #[Optional('media_duration_seconds', nullable: true)]
    public ?float $mediaDurationSeconds;

    #[Optional('media_height_px', nullable: true)]
    public ?float $mediaHeightPx;

    #[Optional('media_width_px', nullable: true)]
    public ?float $mediaWidthPx;

    #[Optional('player_height_px', nullable: true)]
    public ?float $playerHeightPx;

    #[Optional('player_width_px', nullable: true)]
    public ?float $playerWidthPx;

    #[Optional('playing_time_ms')]
    public ?float $playingTimeMs;

    #[Optional('rebuffer_count')]
    public ?float $rebufferCount;

    #[Optional('rebuffer_duration_ms')]
    public ?float $rebufferDurationMs;

    #[Optional('rebuffer_ratio', nullable: true)]
    public ?float $rebufferRatio;

    /** @var list<RenditionPlayingTime>|null $renditionPlayingTime */
    #[Optional(
        'rendition_playing_time',
        list: RenditionPlayingTime::class,
        nullable: true
    )]
    public ?array $renditionPlayingTime;

    #[Optional('rendition_switch_count', nullable: true)]
    public ?float $renditionSwitchCount;

    #[Optional('seek_count')]
    public ?float $seekCount;

    #[Optional('seek_duration_ms')]
    public ?float $seekDurationMs;

    #[Optional('selected_rendition_bitrate_bps', nullable: true)]
    public ?float $selectedRenditionBitrateBps;

    #[Optional('selected_rendition_codec', nullable: true)]
    public ?string $selectedRenditionCodec;

    #[Optional('selected_rendition_height', nullable: true)]
    public ?float $selectedRenditionHeight;

    #[Optional('selected_rendition_width', nullable: true)]
    public ?float $selectedRenditionWidth;

    #[Optional('startup_time_ms', nullable: true)]
    public ?float $startupTimeMs;

    #[Optional('total_video_frames', nullable: true)]
    public ?float $totalVideoFrames;

    /**
     * Optional integrator-supplied user ID, used to link views to the integrator's own users.
     */
    #[Optional('user_id', nullable: true)]
    public ?string $userID;

    /**
     * Optional human-readable video title for reports.
     */
    #[Optional('video_title', nullable: true)]
    public ?string $videoTitle;

    /**
     * Tab visibility when the event was recorded. Hidden does not imply paused playback or identify the cause of a pause. Missing on older events; null when unavailable.
     *
     * @var value-of<VisibilityState>|null $visibilityState
     */
    #[Optional('visibility_state', enum: VisibilityState::class, nullable: true)]
    public ?string $visibilityState;

    /**
     * `new SubtitleChanged()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * SubtitleChanged::with(
     *   connectorName: ...,
     *   connectorVersion: ...,
     *   deliveryHostname: ...,
     *   environment: ...,
     *   errorCategory: ...,
     *   errorCode: ...,
     *   errorFatal: ...,
     *   errorPlayheadSeconds: ...,
     *   eventID: ...,
     *   occurredAt: ...,
     *   playerName: ...,
     *   playerVersion: ...,
     *   playheadSeconds: ...,
     *   previousSubtitleLanguage: ...,
     *   reason: ...,
     *   sdkName: ...,
     *   sdkVersion: ...,
     *   sequence: ...,
     *   startupOutcome: ...,
     *   subtitleLanguage: ...,
     *   videoID: ...,
     *   viewID: ...,
     *   viewerID: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new SubtitleChanged)
     *   ->withConnectorName(...)
     *   ->withConnectorVersion(...)
     *   ->withDeliveryHostname(...)
     *   ->withEnvironment(...)
     *   ->withErrorCategory(...)
     *   ->withErrorCode(...)
     *   ->withErrorFatal(...)
     *   ->withErrorPlayheadSeconds(...)
     *   ->withEventID(...)
     *   ->withOccurredAt(...)
     *   ->withPlayerName(...)
     *   ->withPlayerVersion(...)
     *   ->withPlayheadSeconds(...)
     *   ->withPreviousSubtitleLanguage(...)
     *   ->withReason(...)
     *   ->withSDKName(...)
     *   ->withSDKVersion(...)
     *   ->withSequence(...)
     *   ->withStartupOutcome(...)
     *   ->withSubtitleLanguage(...)
     *   ->withVideoID(...)
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
     * @param ErrorCategory|value-of<ErrorCategory>|null $errorCategory
     * @param ErrorCodeShape|null $errorCode
     * @param Reason|value-of<Reason>|null $reason
     * @param StartupOutcome|value-of<StartupOutcome>|null $startupOutcome
     * @param list<RenditionPlayingTime|RenditionPlayingTimeShape>|Omit|null $renditionPlayingTime
     * @param Omit|VisibilityState|value-of<VisibilityState>|null $visibilityState
     */
    public static function with(
        string $connectorName,
        ?string $connectorVersion,
        ?string $deliveryHostname,
        ?string $environment,
        ErrorCategory|string|null $errorCategory,
        string|float|null $errorCode,
        ?bool $errorFatal,
        ?float $errorPlayheadSeconds,
        string $eventID,
        \DateTimeInterface $occurredAt,
        ?string $playerName,
        ?string $playerVersion,
        ?float $playheadSeconds,
        ?string $previousSubtitleLanguage,
        Reason|string|null $reason,
        string $sdkName,
        string $sdkVersion,
        int $sequence,
        StartupOutcome|string|null $startupOutcome,
        ?string $subtitleLanguage,
        string $videoID,
        string $viewID,
        ?string $viewerID,
        mixed $browserContext = null,
        float|Omit|null $deliveryRequestCount = Omit::Value,
        float|Omit|null $deliveryThroughputBps = Omit::Value,
        float|Omit|null $deliveryTransferredBytes = Omit::Value,
        float|Omit|null $droppedVideoFrames = Omit::Value,
        float|Omit|null $firstVideoFrameTimeMs = Omit::Value,
        float|Omit|null $furthestProgressRatio = Omit::Value,
        ?float $maximumPlayheadSeconds = null,
        float|Omit|null $mediaDurationSeconds = Omit::Value,
        float|Omit|null $mediaHeightPx = Omit::Value,
        float|Omit|null $mediaWidthPx = Omit::Value,
        float|Omit|null $playerHeightPx = Omit::Value,
        float|Omit|null $playerWidthPx = Omit::Value,
        ?float $playingTimeMs = null,
        ?float $rebufferCount = null,
        ?float $rebufferDurationMs = null,
        float|Omit|null $rebufferRatio = Omit::Value,
        array|Omit|null $renditionPlayingTime = Omit::Value,
        float|Omit|null $renditionSwitchCount = Omit::Value,
        ?float $seekCount = null,
        ?float $seekDurationMs = null,
        float|Omit|null $selectedRenditionBitrateBps = Omit::Value,
        string|Omit|null $selectedRenditionCodec = Omit::Value,
        float|Omit|null $selectedRenditionHeight = Omit::Value,
        float|Omit|null $selectedRenditionWidth = Omit::Value,
        float|Omit|null $startupTimeMs = Omit::Value,
        float|Omit|null $totalVideoFrames = Omit::Value,
        string|Omit|null $userID = Omit::Value,
        string|Omit|null $videoTitle = Omit::Value,
        Omit|VisibilityState|string|null $visibilityState = Omit::Value,
    ): self {
        $self = new self;

        $self['connectorName'] = $connectorName;
        $self['connectorVersion'] = $connectorVersion;
        $self['deliveryHostname'] = $deliveryHostname;
        $self['environment'] = $environment;
        $self['errorCategory'] = $errorCategory;
        $self['errorCode'] = $errorCode;
        $self['errorFatal'] = $errorFatal;
        $self['errorPlayheadSeconds'] = $errorPlayheadSeconds;
        $self['eventID'] = $eventID;
        $self['occurredAt'] = $occurredAt;
        $self['playerName'] = $playerName;
        $self['playerVersion'] = $playerVersion;
        $self['playheadSeconds'] = $playheadSeconds;
        $self['previousSubtitleLanguage'] = $previousSubtitleLanguage;
        $self['reason'] = $reason;
        $self['sdkName'] = $sdkName;
        $self['sdkVersion'] = $sdkVersion;
        $self['sequence'] = $sequence;
        $self['startupOutcome'] = $startupOutcome;
        $self['subtitleLanguage'] = $subtitleLanguage;
        $self['videoID'] = $videoID;
        $self['viewID'] = $viewID;
        $self['viewerID'] = $viewerID;

        null !== $browserContext && $self['browserContext'] = $browserContext;
        Omit::Value !== $deliveryRequestCount && $self['deliveryRequestCount'] = $deliveryRequestCount;
        Omit::Value !== $deliveryThroughputBps && $self['deliveryThroughputBps'] = $deliveryThroughputBps;
        Omit::Value !== $deliveryTransferredBytes && $self['deliveryTransferredBytes'] = $deliveryTransferredBytes;
        Omit::Value !== $droppedVideoFrames && $self['droppedVideoFrames'] = $droppedVideoFrames;
        Omit::Value !== $firstVideoFrameTimeMs && $self['firstVideoFrameTimeMs'] = $firstVideoFrameTimeMs;
        Omit::Value !== $furthestProgressRatio && $self['furthestProgressRatio'] = $furthestProgressRatio;
        null !== $maximumPlayheadSeconds && $self['maximumPlayheadSeconds'] = $maximumPlayheadSeconds;
        Omit::Value !== $mediaDurationSeconds && $self['mediaDurationSeconds'] = $mediaDurationSeconds;
        Omit::Value !== $mediaHeightPx && $self['mediaHeightPx'] = $mediaHeightPx;
        Omit::Value !== $mediaWidthPx && $self['mediaWidthPx'] = $mediaWidthPx;
        Omit::Value !== $playerHeightPx && $self['playerHeightPx'] = $playerHeightPx;
        Omit::Value !== $playerWidthPx && $self['playerWidthPx'] = $playerWidthPx;
        null !== $playingTimeMs && $self['playingTimeMs'] = $playingTimeMs;
        null !== $rebufferCount && $self['rebufferCount'] = $rebufferCount;
        null !== $rebufferDurationMs && $self['rebufferDurationMs'] = $rebufferDurationMs;
        Omit::Value !== $rebufferRatio && $self['rebufferRatio'] = $rebufferRatio;
        Omit::Value !== $renditionPlayingTime && $self['renditionPlayingTime'] = $renditionPlayingTime;
        Omit::Value !== $renditionSwitchCount && $self['renditionSwitchCount'] = $renditionSwitchCount;
        null !== $seekCount && $self['seekCount'] = $seekCount;
        null !== $seekDurationMs && $self['seekDurationMs'] = $seekDurationMs;
        Omit::Value !== $selectedRenditionBitrateBps && $self['selectedRenditionBitrateBps'] = $selectedRenditionBitrateBps;
        Omit::Value !== $selectedRenditionCodec && $self['selectedRenditionCodec'] = $selectedRenditionCodec;
        Omit::Value !== $selectedRenditionHeight && $self['selectedRenditionHeight'] = $selectedRenditionHeight;
        Omit::Value !== $selectedRenditionWidth && $self['selectedRenditionWidth'] = $selectedRenditionWidth;
        Omit::Value !== $startupTimeMs && $self['startupTimeMs'] = $startupTimeMs;
        Omit::Value !== $totalVideoFrames && $self['totalVideoFrames'] = $totalVideoFrames;
        Omit::Value !== $userID && $self['userID'] = $userID;
        Omit::Value !== $videoTitle && $self['videoTitle'] = $videoTitle;
        Omit::Value !== $visibilityState && $self['visibilityState'] = $visibilityState;

        return $self;
    }

    public function withConnectorName(string $connectorName): self
    {
        $self = clone $this;
        $self['connectorName'] = $connectorName;

        return $self;
    }

    public function withConnectorVersion(?string $connectorVersion): self
    {
        $self = clone $this;
        $self['connectorVersion'] = $connectorVersion;

        return $self;
    }

    public function withDeliveryHostname(?string $deliveryHostname): self
    {
        $self = clone $this;
        $self['deliveryHostname'] = $deliveryHostname;

        return $self;
    }

    public function withEnvironment(?string $environment): self
    {
        $self = clone $this;
        $self['environment'] = $environment;

        return $self;
    }

    /**
     * @param ErrorCategory|value-of<ErrorCategory>|null $errorCategory
     */
    public function withErrorCategory(
        ErrorCategory|string|null $errorCategory
    ): self {
        $self = clone $this;
        $self['errorCategory'] = $errorCategory;

        return $self;
    }

    /**
     * @param ErrorCodeShape|null $errorCode
     */
    public function withErrorCode(string|float|null $errorCode): self
    {
        $self = clone $this;
        $self['errorCode'] = $errorCode;

        return $self;
    }

    public function withErrorFatal(?bool $errorFatal): self
    {
        $self = clone $this;
        $self['errorFatal'] = $errorFatal;

        return $self;
    }

    public function withErrorPlayheadSeconds(?float $errorPlayheadSeconds): self
    {
        $self = clone $this;
        $self['errorPlayheadSeconds'] = $errorPlayheadSeconds;

        return $self;
    }

    public function withEventID(string $eventID): self
    {
        $self = clone $this;
        $self['eventID'] = $eventID;

        return $self;
    }

    /**
     * @param 'chunkify.video.subtitle_changed' $eventName
     */
    public function withEventName(string $eventName): self
    {
        $self = clone $this;
        $self['eventName'] = $eventName;

        return $self;
    }

    public function withOccurredAt(\DateTimeInterface $occurredAt): self
    {
        $self = clone $this;
        $self['occurredAt'] = $occurredAt;

        return $self;
    }

    public function withPlayerName(?string $playerName): self
    {
        $self = clone $this;
        $self['playerName'] = $playerName;

        return $self;
    }

    public function withPlayerVersion(?string $playerVersion): self
    {
        $self = clone $this;
        $self['playerVersion'] = $playerVersion;

        return $self;
    }

    public function withPlayheadSeconds(?float $playheadSeconds): self
    {
        $self = clone $this;
        $self['playheadSeconds'] = $playheadSeconds;

        return $self;
    }

    /**
     * Language before the change; null when subtitles were off.
     */
    public function withPreviousSubtitleLanguage(
        ?string $previousSubtitleLanguage
    ): self {
        $self = clone $this;
        $self['previousSubtitleLanguage'] = $previousSubtitleLanguage;

        return $self;
    }

    /**
     * @param Reason|value-of<Reason>|null $reason
     */
    public function withReason(Reason|string|null $reason): self
    {
        $self = clone $this;
        $self['reason'] = $reason;

        return $self;
    }

    /**
     * @param 1 $schemaVersion
     */
    public function withSchemaVersion(int $schemaVersion): self
    {
        $self = clone $this;
        $self['schemaVersion'] = $schemaVersion;

        return $self;
    }

    /**
     * Name of the SDK or integration that produced the event. Informational metadata, preserved as received. Must contain at least one non-whitespace character.
     */
    public function withSDKName(string $sdkName): self
    {
        $self = clone $this;
        $self['sdkName'] = $sdkName;

        return $self;
    }

    public function withSDKVersion(string $sdkVersion): self
    {
        $self = clone $this;
        $self['sdkVersion'] = $sdkVersion;

        return $self;
    }

    public function withSequence(int $sequence): self
    {
        $self = clone $this;
        $self['sequence'] = $sequence;

        return $self;
    }

    /**
     * @param StartupOutcome|value-of<StartupOutcome>|null $startupOutcome
     */
    public function withStartupOutcome(
        StartupOutcome|string|null $startupOutcome
    ): self {
        $self = clone $this;
        $self['startupOutcome'] = $startupOutcome;

        return $self;
    }

    /**
     * Language after the change; null when subtitles are now off.
     */
    public function withSubtitleLanguage(?string $subtitleLanguage): self
    {
        $self = clone $this;
        $self['subtitleLanguage'] = $subtitleLanguage;

        return $self;
    }

    public function withVideoID(string $videoID): self
    {
        $self = clone $this;
        $self['videoID'] = $videoID;

        return $self;
    }

    public function withViewID(string $viewID): self
    {
        $self = clone $this;
        $self['viewID'] = $viewID;

        return $self;
    }

    /**
     * Anonymous browser identifier generated by the Chunkify player SDK and stored in the page's localStorage.
     */
    public function withViewerID(?string $viewerID): self
    {
        $self = clone $this;
        $self['viewerID'] = $viewerID;

        return $self;
    }

    /**
     * Optional browser information supplied by the player.
     */
    public function withBrowserContext(mixed $browserContext): self
    {
        $self = clone $this;
        $self['browserContext'] = $browserContext;

        return $self;
    }

    public function withDeliveryRequestCount(?float $deliveryRequestCount): self
    {
        $self = clone $this;
        $self['deliveryRequestCount'] = $deliveryRequestCount;

        return $self;
    }

    public function withDeliveryThroughputBps(
        ?float $deliveryThroughputBps
    ): self {
        $self = clone $this;
        $self['deliveryThroughputBps'] = $deliveryThroughputBps;

        return $self;
    }

    public function withDeliveryTransferredBytes(
        ?float $deliveryTransferredBytes
    ): self {
        $self = clone $this;
        $self['deliveryTransferredBytes'] = $deliveryTransferredBytes;

        return $self;
    }

    public function withDroppedVideoFrames(?float $droppedVideoFrames): self
    {
        $self = clone $this;
        $self['droppedVideoFrames'] = $droppedVideoFrames;

        return $self;
    }

    public function withFirstVideoFrameTimeMs(
        ?float $firstVideoFrameTimeMs
    ): self {
        $self = clone $this;
        $self['firstVideoFrameTimeMs'] = $firstVideoFrameTimeMs;

        return $self;
    }

    public function withFurthestProgressRatio(
        ?float $furthestProgressRatio
    ): self {
        $self = clone $this;
        $self['furthestProgressRatio'] = $furthestProgressRatio;

        return $self;
    }

    public function withMaximumPlayheadSeconds(
        float $maximumPlayheadSeconds
    ): self {
        $self = clone $this;
        $self['maximumPlayheadSeconds'] = $maximumPlayheadSeconds;

        return $self;
    }

    public function withMediaDurationSeconds(?float $mediaDurationSeconds): self
    {
        $self = clone $this;
        $self['mediaDurationSeconds'] = $mediaDurationSeconds;

        return $self;
    }

    public function withMediaHeightPx(?float $mediaHeightPx): self
    {
        $self = clone $this;
        $self['mediaHeightPx'] = $mediaHeightPx;

        return $self;
    }

    public function withMediaWidthPx(?float $mediaWidthPx): self
    {
        $self = clone $this;
        $self['mediaWidthPx'] = $mediaWidthPx;

        return $self;
    }

    public function withPlayerHeightPx(?float $playerHeightPx): self
    {
        $self = clone $this;
        $self['playerHeightPx'] = $playerHeightPx;

        return $self;
    }

    public function withPlayerWidthPx(?float $playerWidthPx): self
    {
        $self = clone $this;
        $self['playerWidthPx'] = $playerWidthPx;

        return $self;
    }

    public function withPlayingTimeMs(float $playingTimeMs): self
    {
        $self = clone $this;
        $self['playingTimeMs'] = $playingTimeMs;

        return $self;
    }

    public function withRebufferCount(float $rebufferCount): self
    {
        $self = clone $this;
        $self['rebufferCount'] = $rebufferCount;

        return $self;
    }

    public function withRebufferDurationMs(float $rebufferDurationMs): self
    {
        $self = clone $this;
        $self['rebufferDurationMs'] = $rebufferDurationMs;

        return $self;
    }

    public function withRebufferRatio(?float $rebufferRatio): self
    {
        $self = clone $this;
        $self['rebufferRatio'] = $rebufferRatio;

        return $self;
    }

    /**
     * @param list<RenditionPlayingTime|RenditionPlayingTimeShape>|null $renditionPlayingTime
     */
    public function withRenditionPlayingTime(?array $renditionPlayingTime): self
    {
        $self = clone $this;
        $self['renditionPlayingTime'] = $renditionPlayingTime;

        return $self;
    }

    public function withRenditionSwitchCount(?float $renditionSwitchCount): self
    {
        $self = clone $this;
        $self['renditionSwitchCount'] = $renditionSwitchCount;

        return $self;
    }

    public function withSeekCount(float $seekCount): self
    {
        $self = clone $this;
        $self['seekCount'] = $seekCount;

        return $self;
    }

    public function withSeekDurationMs(float $seekDurationMs): self
    {
        $self = clone $this;
        $self['seekDurationMs'] = $seekDurationMs;

        return $self;
    }

    public function withSelectedRenditionBitrateBps(
        ?float $selectedRenditionBitrateBps
    ): self {
        $self = clone $this;
        $self['selectedRenditionBitrateBps'] = $selectedRenditionBitrateBps;

        return $self;
    }

    public function withSelectedRenditionCodec(
        ?string $selectedRenditionCodec
    ): self {
        $self = clone $this;
        $self['selectedRenditionCodec'] = $selectedRenditionCodec;

        return $self;
    }

    public function withSelectedRenditionHeight(
        ?float $selectedRenditionHeight
    ): self {
        $self = clone $this;
        $self['selectedRenditionHeight'] = $selectedRenditionHeight;

        return $self;
    }

    public function withSelectedRenditionWidth(
        ?float $selectedRenditionWidth
    ): self {
        $self = clone $this;
        $self['selectedRenditionWidth'] = $selectedRenditionWidth;

        return $self;
    }

    public function withStartupTimeMs(?float $startupTimeMs): self
    {
        $self = clone $this;
        $self['startupTimeMs'] = $startupTimeMs;

        return $self;
    }

    public function withTotalVideoFrames(?float $totalVideoFrames): self
    {
        $self = clone $this;
        $self['totalVideoFrames'] = $totalVideoFrames;

        return $self;
    }

    /**
     * Optional integrator-supplied user ID, used to link views to the integrator's own users.
     */
    public function withUserID(?string $userID): self
    {
        $self = clone $this;
        $self['userID'] = $userID;

        return $self;
    }

    /**
     * Optional human-readable video title for reports.
     */
    public function withVideoTitle(?string $videoTitle): self
    {
        $self = clone $this;
        $self['videoTitle'] = $videoTitle;

        return $self;
    }

    /**
     * Tab visibility when the event was recorded. Hidden does not imply paused playback or identify the cause of a pause. Missing on older events; null when unavailable.
     *
     * @param VisibilityState|value-of<VisibilityState>|null $visibilityState
     */
    public function withVisibilityState(
        VisibilityState|string|null $visibilityState
    ): self {
        $self = clone $this;
        $self['visibilityState'] = $visibilityState;

        return $self;
    }
}
