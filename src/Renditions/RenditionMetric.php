<?php

declare(strict_types=1);

namespace ChunkifyAnalytics\Renditions;

use ChunkifyAnalytics\Core\Attributes\Required;
use ChunkifyAnalytics\Core\Concerns\SdkModel;
use ChunkifyAnalytics\Core\Contracts\BaseModel;

/**
 * One rendition identified by its dimensions, codec, declared bitrate and frame rate.
 *
 * @phpstan-type RenditionMetricShape = array{
 *   bitrateBps: float|null,
 *   codec: string|null,
 *   frameRate: float|null,
 *   height: float|null,
 *   playingTimeMs: float,
 *   playingTimeRatio: float,
 *   views: int,
 *   width: float|null,
 * }
 */
final class RenditionMetric implements BaseModel
{
    /** @use SdkModel<RenditionMetricShape> */
    use SdkModel;

    /**
     * Declared rendition bitrate in bits per second, not measured network throughput.
     */
    #[Required('bitrate_bps')]
    public ?float $bitrateBps;

    /**
     * Reported codec; null when unknown.
     */
    #[Required]
    public ?string $codec;

    /**
     * Reported frames per second; null when unknown.
     */
    #[Required('frame_rate')]
    public ?float $frameRate;

    /**
     * Reported height in pixels; null when unknown.
     */
    #[Required]
    public ?float $height;

    /**
     * Cumulative measured playing time for this rendition, summed once per attempt.
     */
    #[Required('playing_time_ms')]
    public float $playingTimeMs;

    /**
     * Share of all measured rendition playing time, including rows outside the returned limit.
     */
    #[Required('playing_time_ratio')]
    public float $playingTimeRatio;

    /**
     * Distinct attempts with positive playing time for this rendition.
     */
    #[Required]
    public int $views;

    /**
     * Reported width in pixels; null when unknown.
     */
    #[Required]
    public ?float $width;

    /**
     * `new RenditionMetric()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * RenditionMetric::with(
     *   bitrateBps: ...,
     *   codec: ...,
     *   frameRate: ...,
     *   height: ...,
     *   playingTimeMs: ...,
     *   playingTimeRatio: ...,
     *   views: ...,
     *   width: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new RenditionMetric)
     *   ->withBitrateBps(...)
     *   ->withCodec(...)
     *   ->withFrameRate(...)
     *   ->withHeight(...)
     *   ->withPlayingTimeMs(...)
     *   ->withPlayingTimeRatio(...)
     *   ->withViews(...)
     *   ->withWidth(...)
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
        ?float $bitrateBps,
        ?string $codec,
        ?float $frameRate,
        ?float $height,
        float $playingTimeMs,
        float $playingTimeRatio,
        int $views,
        ?float $width,
    ): self {
        $self = new self;

        $self['bitrateBps'] = $bitrateBps;
        $self['codec'] = $codec;
        $self['frameRate'] = $frameRate;
        $self['height'] = $height;
        $self['playingTimeMs'] = $playingTimeMs;
        $self['playingTimeRatio'] = $playingTimeRatio;
        $self['views'] = $views;
        $self['width'] = $width;

        return $self;
    }

    /**
     * Declared rendition bitrate in bits per second, not measured network throughput.
     */
    public function withBitrateBps(?float $bitrateBps): self
    {
        $self = clone $this;
        $self['bitrateBps'] = $bitrateBps;

        return $self;
    }

    /**
     * Reported codec; null when unknown.
     */
    public function withCodec(?string $codec): self
    {
        $self = clone $this;
        $self['codec'] = $codec;

        return $self;
    }

    /**
     * Reported frames per second; null when unknown.
     */
    public function withFrameRate(?float $frameRate): self
    {
        $self = clone $this;
        $self['frameRate'] = $frameRate;

        return $self;
    }

    /**
     * Reported height in pixels; null when unknown.
     */
    public function withHeight(?float $height): self
    {
        $self = clone $this;
        $self['height'] = $height;

        return $self;
    }

    /**
     * Cumulative measured playing time for this rendition, summed once per attempt.
     */
    public function withPlayingTimeMs(float $playingTimeMs): self
    {
        $self = clone $this;
        $self['playingTimeMs'] = $playingTimeMs;

        return $self;
    }

    /**
     * Share of all measured rendition playing time, including rows outside the returned limit.
     */
    public function withPlayingTimeRatio(float $playingTimeRatio): self
    {
        $self = clone $this;
        $self['playingTimeRatio'] = $playingTimeRatio;

        return $self;
    }

    /**
     * Distinct attempts with positive playing time for this rendition.
     */
    public function withViews(int $views): self
    {
        $self = clone $this;
        $self['views'] = $views;

        return $self;
    }

    /**
     * Reported width in pixels; null when unknown.
     */
    public function withWidth(?float $width): self
    {
        $self = clone $this;
        $self['width'] = $width;

        return $self;
    }
}
