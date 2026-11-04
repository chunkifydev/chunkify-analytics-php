<?php

declare(strict_types=1);

namespace ChunkifyAnalytics\Events;

use ChunkifyAnalytics\Core\Attributes\Optional;
use ChunkifyAnalytics\Core\Attributes\Required;
use ChunkifyAnalytics\Core\Concerns\SdkModel;
use ChunkifyAnalytics\Core\Contracts\BaseModel;
use ChunkifyAnalytics\Core\Omit;
use ChunkifyAnalytics\Events\ViewSnapshot\ErrorCategory;
use ChunkifyAnalytics\Events\ViewSnapshot\Reason;
use ChunkifyAnalytics\Events\ViewSnapshot\StartupOutcome;
use ChunkifyAnalytics\Events\ViewSnapshot\VisibilityState;
use ChunkifyAnalytics\PlayedRange;
use ChunkifyAnalytics\RenditionPlayingTime;

/**
 * @phpstan-import-type ErrorCodeVariants from \ChunkifyAnalytics\Events\ViewSnapshot\ErrorCode
 * @phpstan-import-type ErrorCodeShape from \ChunkifyAnalytics\Events\ViewSnapshot\ErrorCode
 * @phpstan-import-type RenditionPlayingTimeShape from \ChunkifyAnalytics\RenditionPlayingTime
 * @phpstan-import-type PlayedRangeShape from \ChunkifyAnalytics\PlayedRange
 *
 * @phpstan-type ViewSnapshotShape = array{
 *   connectorName: string,
 *   connectorVersion: string|null,
 *   deliveryHostname: string|null,
 *   deliveryRequestCount: float|null,
 *   deliveryThroughputBps: float|null,
 *   deliveryTransferredBytes: float|null,
 *   droppedVideoFrames: float|null,
 *   environment: string|null,
 *   errorCategory: null|ErrorCategory|value-of<ErrorCategory>,
 *   errorCode: ErrorCodeShape|null,
 *   errorFatal: bool|null,
 *   errorPlayheadSeconds: float|null,
 *   eventID: string,
 *   eventName: 'chunkify.video.view_snapshot',
 *   firstVideoFrameTimeMs: float|null,
 *   furthestProgressRatio: float|null,
 *   maximumPlayheadSeconds: float,
 *   mediaDurationSeconds: float|null,
 *   mediaHeightPx: float|null,
 *   mediaWidthPx: float|null,
 *   occurredAt: \DateTimeInterface,
 *   playerHeightPx: float|null,
 *   playerName: string|null,
 *   playerVersion: string|null,
 *   playerWidthPx: float|null,
 *   playingTimeMs: float,
 *   reason: null|Reason|value-of<Reason>,
 *   rebufferCount: float,
 *   rebufferDurationMs: float,
 *   rebufferRatio: float|null,
 *   renditionPlayingTime: list<RenditionPlayingTime|RenditionPlayingTimeShape>|null,
 *   renditionSwitchCount: float|null,
 *   schemaVersion: 1,
 *   sdkName: string,
 *   sdkVersion: string,
 *   seekCount: float,
 *   seekDurationMs: float,
 *   selectedRenditionBitrateBps: float|null,
 *   selectedRenditionCodec: string|null,
 *   selectedRenditionHeight: float|null,
 *   selectedRenditionWidth: float|null,
 *   sequence: int,
 *   startupOutcome: null|StartupOutcome|value-of<StartupOutcome>,
 *   startupTimeMs: float|null,
 *   totalVideoFrames: float|null,
 *   videoID: string,
 *   viewID: string,
 *   viewerID: string|null,
 *   browserContext?: mixed,
 *   playedRanges?: list<PlayedRange|PlayedRangeShape>|null,
 *   playheadSeconds?: float|null,
 *   visibilityState?: null|VisibilityState|value-of<VisibilityState>,
 * }
 */
final class ViewSnapshot implements BaseModel
{
    /** @use SdkModel<ViewSnapshotShape> */
    use SdkModel;

    /** @var 'chunkify.video.view_snapshot' $eventName */
    #[Required('event_name')]
    public string $eventName = 'chunkify.video.view_snapshot';

    /** @var 1 $schemaVersion */
    #[Required('schema_version')]
    public int $schemaVersion = 1;

    #[Required('connector_name')]
    public string $connectorName;

    #[Required('connector_version')]
    public ?string $connectorVersion;

    #[Required('delivery_hostname')]
    public ?string $deliveryHostname;

    #[Required('delivery_request_count')]
    public ?float $deliveryRequestCount;

    #[Required('delivery_throughput_bps')]
    public ?float $deliveryThroughputBps;

    #[Required('delivery_transferred_bytes')]
    public ?float $deliveryTransferredBytes;

    #[Required('dropped_video_frames')]
    public ?float $droppedVideoFrames;

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

    #[Required('first_video_frame_time_ms')]
    public ?float $firstVideoFrameTimeMs;

    #[Required('furthest_progress_ratio')]
    public ?float $furthestProgressRatio;

    #[Required('maximum_playhead_seconds')]
    public float $maximumPlayheadSeconds;

    #[Required('media_duration_seconds')]
    public ?float $mediaDurationSeconds;

    #[Required('media_height_px')]
    public ?float $mediaHeightPx;

    #[Required('media_width_px')]
    public ?float $mediaWidthPx;

    #[Required('occurred_at')]
    public \DateTimeInterface $occurredAt;

    #[Required('player_height_px')]
    public ?float $playerHeightPx;

    #[Required('player_name')]
    public ?string $playerName;

    #[Required('player_version')]
    public ?string $playerVersion;

    #[Required('player_width_px')]
    public ?float $playerWidthPx;

    #[Required('playing_time_ms')]
    public float $playingTimeMs;

    /** @var value-of<Reason>|null $reason */
    #[Required(enum: Reason::class)]
    public ?string $reason;

    #[Required('rebuffer_count')]
    public float $rebufferCount;

    #[Required('rebuffer_duration_ms')]
    public float $rebufferDurationMs;

    #[Required('rebuffer_ratio')]
    public ?float $rebufferRatio;

    /** @var list<RenditionPlayingTime>|null $renditionPlayingTime */
    #[Required('rendition_playing_time', list: RenditionPlayingTime::class)]
    public ?array $renditionPlayingTime;

    #[Required('rendition_switch_count')]
    public ?float $renditionSwitchCount;

    /**
     * Name of the SDK or integration that produced the event. Informational metadata, preserved as received. Must contain at least one non-whitespace character.
     */
    #[Required('sdk_name')]
    public string $sdkName;

    #[Required('sdk_version')]
    public string $sdkVersion;

    #[Required('seek_count')]
    public float $seekCount;

    #[Required('seek_duration_ms')]
    public float $seekDurationMs;

    #[Required('selected_rendition_bitrate_bps')]
    public ?float $selectedRenditionBitrateBps;

    #[Required('selected_rendition_codec')]
    public ?string $selectedRenditionCodec;

    #[Required('selected_rendition_height')]
    public ?float $selectedRenditionHeight;

    #[Required('selected_rendition_width')]
    public ?float $selectedRenditionWidth;

    #[Required]
    public int $sequence;

    /** @var value-of<StartupOutcome>|null $startupOutcome */
    #[Required('startup_outcome', enum: StartupOutcome::class)]
    public ?string $startupOutcome;

    #[Required('startup_time_ms')]
    public ?float $startupTimeMs;

    #[Required('total_video_frames')]
    public ?float $totalVideoFrames;

    #[Required('video_id')]
    public string $videoID;

    #[Required('view_id')]
    public string $viewID;

    #[Required('viewer_id')]
    public ?string $viewerID;

    /**
     * Optional browser information supplied by the player.
     */
    #[Optional('browser_context')]
    public mixed $browserContext;

    /**
     * Cumulative played media ranges for this attempt, sorted and merged without overlaps. Seeking, pauses and buffering are excluded. Missing or null means unavailable; an empty array means measured but no section played. Replaying a section does not add another range.
     *
     * @var list<PlayedRange>|null $playedRanges
     */
    #[Optional('played_ranges', list: PlayedRange::class, nullable: true)]
    public ?array $playedRanges;

    /**
     * Current media position at this event, not the maximum reached.
     */
    #[Optional('playhead_seconds', nullable: true)]
    public ?float $playheadSeconds;

    /**
     * Tab visibility when the event was recorded. Hidden does not imply paused playback or identify the cause of a pause. Missing on older events; null when unavailable.
     *
     * @var value-of<VisibilityState>|null $visibilityState
     */
    #[Optional('visibility_state', enum: VisibilityState::class, nullable: true)]
    public ?string $visibilityState;

    /**
     * `new ViewSnapshot()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ViewSnapshot::with(
     *   connectorName: ...,
     *   connectorVersion: ...,
     *   deliveryHostname: ...,
     *   deliveryRequestCount: ...,
     *   deliveryThroughputBps: ...,
     *   deliveryTransferredBytes: ...,
     *   droppedVideoFrames: ...,
     *   environment: ...,
     *   errorCategory: ...,
     *   errorCode: ...,
     *   errorFatal: ...,
     *   errorPlayheadSeconds: ...,
     *   eventID: ...,
     *   firstVideoFrameTimeMs: ...,
     *   furthestProgressRatio: ...,
     *   maximumPlayheadSeconds: ...,
     *   mediaDurationSeconds: ...,
     *   mediaHeightPx: ...,
     *   mediaWidthPx: ...,
     *   occurredAt: ...,
     *   playerHeightPx: ...,
     *   playerName: ...,
     *   playerVersion: ...,
     *   playerWidthPx: ...,
     *   playingTimeMs: ...,
     *   reason: ...,
     *   rebufferCount: ...,
     *   rebufferDurationMs: ...,
     *   rebufferRatio: ...,
     *   renditionPlayingTime: ...,
     *   renditionSwitchCount: ...,
     *   sdkName: ...,
     *   sdkVersion: ...,
     *   seekCount: ...,
     *   seekDurationMs: ...,
     *   selectedRenditionBitrateBps: ...,
     *   selectedRenditionCodec: ...,
     *   selectedRenditionHeight: ...,
     *   selectedRenditionWidth: ...,
     *   sequence: ...,
     *   startupOutcome: ...,
     *   startupTimeMs: ...,
     *   totalVideoFrames: ...,
     *   videoID: ...,
     *   viewID: ...,
     *   viewerID: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ViewSnapshot)
     *   ->withConnectorName(...)
     *   ->withConnectorVersion(...)
     *   ->withDeliveryHostname(...)
     *   ->withDeliveryRequestCount(...)
     *   ->withDeliveryThroughputBps(...)
     *   ->withDeliveryTransferredBytes(...)
     *   ->withDroppedVideoFrames(...)
     *   ->withEnvironment(...)
     *   ->withErrorCategory(...)
     *   ->withErrorCode(...)
     *   ->withErrorFatal(...)
     *   ->withErrorPlayheadSeconds(...)
     *   ->withEventID(...)
     *   ->withFirstVideoFrameTimeMs(...)
     *   ->withFurthestProgressRatio(...)
     *   ->withMaximumPlayheadSeconds(...)
     *   ->withMediaDurationSeconds(...)
     *   ->withMediaHeightPx(...)
     *   ->withMediaWidthPx(...)
     *   ->withOccurredAt(...)
     *   ->withPlayerHeightPx(...)
     *   ->withPlayerName(...)
     *   ->withPlayerVersion(...)
     *   ->withPlayerWidthPx(...)
     *   ->withPlayingTimeMs(...)
     *   ->withReason(...)
     *   ->withRebufferCount(...)
     *   ->withRebufferDurationMs(...)
     *   ->withRebufferRatio(...)
     *   ->withRenditionPlayingTime(...)
     *   ->withRenditionSwitchCount(...)
     *   ->withSDKName(...)
     *   ->withSDKVersion(...)
     *   ->withSeekCount(...)
     *   ->withSeekDurationMs(...)
     *   ->withSelectedRenditionBitrateBps(...)
     *   ->withSelectedRenditionCodec(...)
     *   ->withSelectedRenditionHeight(...)
     *   ->withSelectedRenditionWidth(...)
     *   ->withSequence(...)
     *   ->withStartupOutcome(...)
     *   ->withStartupTimeMs(...)
     *   ->withTotalVideoFrames(...)
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
     * @param list<RenditionPlayingTime|RenditionPlayingTimeShape>|null $renditionPlayingTime
     * @param StartupOutcome|value-of<StartupOutcome>|null $startupOutcome
     * @param list<PlayedRange|PlayedRangeShape>|Omit|null $playedRanges
     * @param Omit|VisibilityState|value-of<VisibilityState>|null $visibilityState
     */
    public static function with(
        string $connectorName,
        ?string $connectorVersion,
        ?string $deliveryHostname,
        ?float $deliveryRequestCount,
        ?float $deliveryThroughputBps,
        ?float $deliveryTransferredBytes,
        ?float $droppedVideoFrames,
        ?string $environment,
        ErrorCategory|string|null $errorCategory,
        string|float|null $errorCode,
        ?bool $errorFatal,
        ?float $errorPlayheadSeconds,
        string $eventID,
        ?float $firstVideoFrameTimeMs,
        ?float $furthestProgressRatio,
        float $maximumPlayheadSeconds,
        ?float $mediaDurationSeconds,
        ?float $mediaHeightPx,
        ?float $mediaWidthPx,
        \DateTimeInterface $occurredAt,
        ?float $playerHeightPx,
        ?string $playerName,
        ?string $playerVersion,
        ?float $playerWidthPx,
        float $playingTimeMs,
        Reason|string|null $reason,
        float $rebufferCount,
        float $rebufferDurationMs,
        ?float $rebufferRatio,
        ?array $renditionPlayingTime,
        ?float $renditionSwitchCount,
        string $sdkName,
        string $sdkVersion,
        float $seekCount,
        float $seekDurationMs,
        ?float $selectedRenditionBitrateBps,
        ?string $selectedRenditionCodec,
        ?float $selectedRenditionHeight,
        ?float $selectedRenditionWidth,
        int $sequence,
        StartupOutcome|string|null $startupOutcome,
        ?float $startupTimeMs,
        ?float $totalVideoFrames,
        string $videoID,
        string $viewID,
        ?string $viewerID,
        mixed $browserContext = null,
        array|Omit|null $playedRanges = Omit::Value,
        float|Omit|null $playheadSeconds = Omit::Value,
        Omit|VisibilityState|string|null $visibilityState = Omit::Value,
    ): self {
        $self = new self;

        $self['connectorName'] = $connectorName;
        $self['connectorVersion'] = $connectorVersion;
        $self['deliveryHostname'] = $deliveryHostname;
        $self['deliveryRequestCount'] = $deliveryRequestCount;
        $self['deliveryThroughputBps'] = $deliveryThroughputBps;
        $self['deliveryTransferredBytes'] = $deliveryTransferredBytes;
        $self['droppedVideoFrames'] = $droppedVideoFrames;
        $self['environment'] = $environment;
        $self['errorCategory'] = $errorCategory;
        $self['errorCode'] = $errorCode;
        $self['errorFatal'] = $errorFatal;
        $self['errorPlayheadSeconds'] = $errorPlayheadSeconds;
        $self['eventID'] = $eventID;
        $self['firstVideoFrameTimeMs'] = $firstVideoFrameTimeMs;
        $self['furthestProgressRatio'] = $furthestProgressRatio;
        $self['maximumPlayheadSeconds'] = $maximumPlayheadSeconds;
        $self['mediaDurationSeconds'] = $mediaDurationSeconds;
        $self['mediaHeightPx'] = $mediaHeightPx;
        $self['mediaWidthPx'] = $mediaWidthPx;
        $self['occurredAt'] = $occurredAt;
        $self['playerHeightPx'] = $playerHeightPx;
        $self['playerName'] = $playerName;
        $self['playerVersion'] = $playerVersion;
        $self['playerWidthPx'] = $playerWidthPx;
        $self['playingTimeMs'] = $playingTimeMs;
        $self['reason'] = $reason;
        $self['rebufferCount'] = $rebufferCount;
        $self['rebufferDurationMs'] = $rebufferDurationMs;
        $self['rebufferRatio'] = $rebufferRatio;
        $self['renditionPlayingTime'] = $renditionPlayingTime;
        $self['renditionSwitchCount'] = $renditionSwitchCount;
        $self['sdkName'] = $sdkName;
        $self['sdkVersion'] = $sdkVersion;
        $self['seekCount'] = $seekCount;
        $self['seekDurationMs'] = $seekDurationMs;
        $self['selectedRenditionBitrateBps'] = $selectedRenditionBitrateBps;
        $self['selectedRenditionCodec'] = $selectedRenditionCodec;
        $self['selectedRenditionHeight'] = $selectedRenditionHeight;
        $self['selectedRenditionWidth'] = $selectedRenditionWidth;
        $self['sequence'] = $sequence;
        $self['startupOutcome'] = $startupOutcome;
        $self['startupTimeMs'] = $startupTimeMs;
        $self['totalVideoFrames'] = $totalVideoFrames;
        $self['videoID'] = $videoID;
        $self['viewID'] = $viewID;
        $self['viewerID'] = $viewerID;

        null !== $browserContext && $self['browserContext'] = $browserContext;
        Omit::Value !== $playedRanges && $self['playedRanges'] = $playedRanges;
        Omit::Value !== $playheadSeconds && $self['playheadSeconds'] = $playheadSeconds;
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
     * @param 'chunkify.video.view_snapshot' $eventName
     */
    public function withEventName(string $eventName): self
    {
        $self = clone $this;
        $self['eventName'] = $eventName;

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

    public function withOccurredAt(\DateTimeInterface $occurredAt): self
    {
        $self = clone $this;
        $self['occurredAt'] = $occurredAt;

        return $self;
    }

    public function withPlayerHeightPx(?float $playerHeightPx): self
    {
        $self = clone $this;
        $self['playerHeightPx'] = $playerHeightPx;

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

    /**
     * @param Reason|value-of<Reason>|null $reason
     */
    public function withReason(Reason|string|null $reason): self
    {
        $self = clone $this;
        $self['reason'] = $reason;

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

    /**
     * Cumulative played media ranges for this attempt, sorted and merged without overlaps. Seeking, pauses and buffering are excluded. Missing or null means unavailable; an empty array means measured but no section played. Replaying a section does not add another range.
     *
     * @param list<PlayedRange|PlayedRangeShape>|null $playedRanges
     */
    public function withPlayedRanges(?array $playedRanges): self
    {
        $self = clone $this;
        $self['playedRanges'] = $playedRanges;

        return $self;
    }

    /**
     * Current media position at this event, not the maximum reached.
     */
    public function withPlayheadSeconds(?float $playheadSeconds): self
    {
        $self = clone $this;
        $self['playheadSeconds'] = $playheadSeconds;

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
