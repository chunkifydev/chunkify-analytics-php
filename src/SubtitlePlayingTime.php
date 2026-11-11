<?php

declare(strict_types=1);

namespace ChunkifyAnalytics;

use ChunkifyAnalytics\Core\Attributes\Required;
use ChunkifyAnalytics\Core\Concerns\SdkModel;
use ChunkifyAnalytics\Core\Contracts\BaseModel;

/**
 * @phpstan-type SubtitlePlayingTimeShape = array{
 *   language: string|null, playingTimeMs: float
 * }
 */
final class SubtitlePlayingTime implements BaseModel
{
    /** @use SdkModel<SubtitlePlayingTimeShape> */
    use SdkModel;

    /**
     * Subtitle language tag, or null for subtitles off.
     */
    #[Required]
    public ?string $language;

    #[Required('playing_time_ms')]
    public float $playingTimeMs;

    /**
     * `new SubtitlePlayingTime()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * SubtitlePlayingTime::with(language: ..., playingTimeMs: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new SubtitlePlayingTime)->withLanguage(...)->withPlayingTimeMs(...)
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
    public static function with(?string $language, float $playingTimeMs): self
    {
        $self = new self;

        $self['language'] = $language;
        $self['playingTimeMs'] = $playingTimeMs;

        return $self;
    }

    /**
     * Subtitle language tag, or null for subtitles off.
     */
    public function withLanguage(?string $language): self
    {
        $self = clone $this;
        $self['language'] = $language;

        return $self;
    }

    public function withPlayingTimeMs(float $playingTimeMs): self
    {
        $self = clone $this;
        $self['playingTimeMs'] = $playingTimeMs;

        return $self;
    }
}
