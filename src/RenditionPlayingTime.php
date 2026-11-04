<?php

declare(strict_types=1);

namespace ChunkifyAnalytics;

use ChunkifyAnalytics\Core\Attributes\Required;
use ChunkifyAnalytics\Core\Concerns\SdkModel;
use ChunkifyAnalytics\Core\Contracts\BaseModel;

/**
 * @phpstan-type RenditionPlayingTimeShape = array{
 *   bitrateBps: float|null,
 *   codec: string|null,
 *   frameRate: float|null,
 *   height: float|null,
 *   playingTimeMs: float,
 *   width: float|null,
 * }
 */
final class RenditionPlayingTime implements BaseModel
{
    /** @use SdkModel<RenditionPlayingTimeShape> */
    use SdkModel;

    #[Required('bitrate_bps')]
    public ?float $bitrateBps;

    #[Required]
    public ?string $codec;

    #[Required('frame_rate')]
    public ?float $frameRate;

    #[Required]
    public ?float $height;

    #[Required('playing_time_ms')]
    public float $playingTimeMs;

    #[Required]
    public ?float $width;

    /**
     * `new RenditionPlayingTime()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * RenditionPlayingTime::with(
     *   bitrateBps: ...,
     *   codec: ...,
     *   frameRate: ...,
     *   height: ...,
     *   playingTimeMs: ...,
     *   width: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new RenditionPlayingTime)
     *   ->withBitrateBps(...)
     *   ->withCodec(...)
     *   ->withFrameRate(...)
     *   ->withHeight(...)
     *   ->withPlayingTimeMs(...)
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
        ?float $width,
    ): self {
        $self = new self;

        $self['bitrateBps'] = $bitrateBps;
        $self['codec'] = $codec;
        $self['frameRate'] = $frameRate;
        $self['height'] = $height;
        $self['playingTimeMs'] = $playingTimeMs;
        $self['width'] = $width;

        return $self;
    }

    public function withBitrateBps(?float $bitrateBps): self
    {
        $self = clone $this;
        $self['bitrateBps'] = $bitrateBps;

        return $self;
    }

    public function withCodec(?string $codec): self
    {
        $self = clone $this;
        $self['codec'] = $codec;

        return $self;
    }

    public function withFrameRate(?float $frameRate): self
    {
        $self = clone $this;
        $self['frameRate'] = $frameRate;

        return $self;
    }

    public function withHeight(?float $height): self
    {
        $self = clone $this;
        $self['height'] = $height;

        return $self;
    }

    public function withPlayingTimeMs(float $playingTimeMs): self
    {
        $self = clone $this;
        $self['playingTimeMs'] = $playingTimeMs;

        return $self;
    }

    public function withWidth(?float $width): self
    {
        $self = clone $this;
        $self['width'] = $width;

        return $self;
    }
}
