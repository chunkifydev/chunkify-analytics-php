<?php

declare(strict_types=1);

namespace ChunkifyAnalytics;

use ChunkifyAnalytics\Core\Attributes\Optional;
use ChunkifyAnalytics\Core\Attributes\Required;
use ChunkifyAnalytics\Core\Concerns\SdkModel;
use ChunkifyAnalytics\Core\Contracts\BaseModel;
use ChunkifyAnalytics\Core\Omit;

/**
 * @phpstan-import-type RenditionPlayingTimeShape from \ChunkifyAnalytics\RenditionPlayingTime
 * @phpstan-import-type PlayedRangeShape from \ChunkifyAnalytics\PlayedRange
 *
 * @phpstan-type ViewMetricsShape = array{
 *   deliveryRequestCount: float|null,
 *   deliveryThroughputBps: float|null,
 *   deliveryTransferredBytes: float|null,
 *   droppedVideoFrames: float|null,
 *   firstVideoFrameTimeMs: float|null,
 *   furthestProgressRatio: float|null,
 *   maximumPlayheadSeconds: float,
 *   mediaDurationSeconds: float|null,
 *   mediaHeightPx: float|null,
 *   mediaWidthPx: float|null,
 *   playerHeightPx: float|null,
 *   playerWidthPx: float|null,
 *   playingTimeMs: float,
 *   rebufferCount: float,
 *   rebufferDurationMs: float,
 *   rebufferRatio: float|null,
 *   renditionPlayingTime: list<RenditionPlayingTime|RenditionPlayingTimeShape>|null,
 *   renditionSwitchCount: float|null,
 *   seekCount: float,
 *   seekDurationMs: float,
 *   selectedRenditionBitrateBps: float|null,
 *   selectedRenditionCodec: string|null,
 *   selectedRenditionHeight: float|null,
 *   selectedRenditionWidth: float|null,
 *   startupTimeMs: float|null,
 *   totalVideoFrames: float|null,
 *   playedRanges?: list<PlayedRange|PlayedRangeShape>|null,
 *   playheadSeconds?: float|null,
 * }
 */
final class ViewMetrics implements BaseModel
{
    /** @use SdkModel<ViewMetricsShape> */
    use SdkModel;

    #[Required('delivery_request_count')]
    public ?float $deliveryRequestCount;

    #[Required('delivery_throughput_bps')]
    public ?float $deliveryThroughputBps;

    #[Required('delivery_transferred_bytes')]
    public ?float $deliveryTransferredBytes;

    #[Required('dropped_video_frames')]
    public ?float $droppedVideoFrames;

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

    #[Required('player_height_px')]
    public ?float $playerHeightPx;

    #[Required('player_width_px')]
    public ?float $playerWidthPx;

    #[Required('playing_time_ms')]
    public float $playingTimeMs;

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

    #[Required('startup_time_ms')]
    public ?float $startupTimeMs;

    #[Required('total_video_frames')]
    public ?float $totalVideoFrames;

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
     * `new ViewMetrics()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ViewMetrics::with(
     *   deliveryRequestCount: ...,
     *   deliveryThroughputBps: ...,
     *   deliveryTransferredBytes: ...,
     *   droppedVideoFrames: ...,
     *   firstVideoFrameTimeMs: ...,
     *   furthestProgressRatio: ...,
     *   maximumPlayheadSeconds: ...,
     *   mediaDurationSeconds: ...,
     *   mediaHeightPx: ...,
     *   mediaWidthPx: ...,
     *   playerHeightPx: ...,
     *   playerWidthPx: ...,
     *   playingTimeMs: ...,
     *   rebufferCount: ...,
     *   rebufferDurationMs: ...,
     *   rebufferRatio: ...,
     *   renditionPlayingTime: ...,
     *   renditionSwitchCount: ...,
     *   seekCount: ...,
     *   seekDurationMs: ...,
     *   selectedRenditionBitrateBps: ...,
     *   selectedRenditionCodec: ...,
     *   selectedRenditionHeight: ...,
     *   selectedRenditionWidth: ...,
     *   startupTimeMs: ...,
     *   totalVideoFrames: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ViewMetrics)
     *   ->withDeliveryRequestCount(...)
     *   ->withDeliveryThroughputBps(...)
     *   ->withDeliveryTransferredBytes(...)
     *   ->withDroppedVideoFrames(...)
     *   ->withFirstVideoFrameTimeMs(...)
     *   ->withFurthestProgressRatio(...)
     *   ->withMaximumPlayheadSeconds(...)
     *   ->withMediaDurationSeconds(...)
     *   ->withMediaHeightPx(...)
     *   ->withMediaWidthPx(...)
     *   ->withPlayerHeightPx(...)
     *   ->withPlayerWidthPx(...)
     *   ->withPlayingTimeMs(...)
     *   ->withRebufferCount(...)
     *   ->withRebufferDurationMs(...)
     *   ->withRebufferRatio(...)
     *   ->withRenditionPlayingTime(...)
     *   ->withRenditionSwitchCount(...)
     *   ->withSeekCount(...)
     *   ->withSeekDurationMs(...)
     *   ->withSelectedRenditionBitrateBps(...)
     *   ->withSelectedRenditionCodec(...)
     *   ->withSelectedRenditionHeight(...)
     *   ->withSelectedRenditionWidth(...)
     *   ->withStartupTimeMs(...)
     *   ->withTotalVideoFrames(...)
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
     * @param list<RenditionPlayingTime|RenditionPlayingTimeShape>|null $renditionPlayingTime
     * @param list<PlayedRange|PlayedRangeShape>|Omit|null $playedRanges
     */
    public static function with(
        ?float $deliveryRequestCount,
        ?float $deliveryThroughputBps,
        ?float $deliveryTransferredBytes,
        ?float $droppedVideoFrames,
        ?float $firstVideoFrameTimeMs,
        ?float $furthestProgressRatio,
        float $maximumPlayheadSeconds,
        ?float $mediaDurationSeconds,
        ?float $mediaHeightPx,
        ?float $mediaWidthPx,
        ?float $playerHeightPx,
        ?float $playerWidthPx,
        float $playingTimeMs,
        float $rebufferCount,
        float $rebufferDurationMs,
        ?float $rebufferRatio,
        ?array $renditionPlayingTime,
        ?float $renditionSwitchCount,
        float $seekCount,
        float $seekDurationMs,
        ?float $selectedRenditionBitrateBps,
        ?string $selectedRenditionCodec,
        ?float $selectedRenditionHeight,
        ?float $selectedRenditionWidth,
        ?float $startupTimeMs,
        ?float $totalVideoFrames,
        array|Omit|null $playedRanges = Omit::Value,
        float|Omit|null $playheadSeconds = Omit::Value,
    ): self {
        $self = new self;

        $self['deliveryRequestCount'] = $deliveryRequestCount;
        $self['deliveryThroughputBps'] = $deliveryThroughputBps;
        $self['deliveryTransferredBytes'] = $deliveryTransferredBytes;
        $self['droppedVideoFrames'] = $droppedVideoFrames;
        $self['firstVideoFrameTimeMs'] = $firstVideoFrameTimeMs;
        $self['furthestProgressRatio'] = $furthestProgressRatio;
        $self['maximumPlayheadSeconds'] = $maximumPlayheadSeconds;
        $self['mediaDurationSeconds'] = $mediaDurationSeconds;
        $self['mediaHeightPx'] = $mediaHeightPx;
        $self['mediaWidthPx'] = $mediaWidthPx;
        $self['playerHeightPx'] = $playerHeightPx;
        $self['playerWidthPx'] = $playerWidthPx;
        $self['playingTimeMs'] = $playingTimeMs;
        $self['rebufferCount'] = $rebufferCount;
        $self['rebufferDurationMs'] = $rebufferDurationMs;
        $self['rebufferRatio'] = $rebufferRatio;
        $self['renditionPlayingTime'] = $renditionPlayingTime;
        $self['renditionSwitchCount'] = $renditionSwitchCount;
        $self['seekCount'] = $seekCount;
        $self['seekDurationMs'] = $seekDurationMs;
        $self['selectedRenditionBitrateBps'] = $selectedRenditionBitrateBps;
        $self['selectedRenditionCodec'] = $selectedRenditionCodec;
        $self['selectedRenditionHeight'] = $selectedRenditionHeight;
        $self['selectedRenditionWidth'] = $selectedRenditionWidth;
        $self['startupTimeMs'] = $startupTimeMs;
        $self['totalVideoFrames'] = $totalVideoFrames;

        Omit::Value !== $playedRanges && $self['playedRanges'] = $playedRanges;
        Omit::Value !== $playheadSeconds && $self['playheadSeconds'] = $playheadSeconds;

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
}
