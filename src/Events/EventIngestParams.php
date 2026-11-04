<?php

declare(strict_types=1);

namespace ChunkifyAnalytics\Events;

use ChunkifyAnalytics\Core\Attributes\Optional;
use ChunkifyAnalytics\Core\Attributes\Required;
use ChunkifyAnalytics\Core\Concerns\SdkModel;
use ChunkifyAnalytics\Core\Concerns\SdkParams;
use ChunkifyAnalytics\Core\Contracts\BaseModel;
use ChunkifyAnalytics\Events\EventIngestParams\ContentEncoding;

/**
 * Send one playback event using a public key. Success confirms storage completed.
 *
 * @see ChunkifyAnalytics\Services\EventsService::ingest()
 *
 * @phpstan-import-type AnalyticsEventVariants from \ChunkifyAnalytics\Events\AnalyticsEvent
 * @phpstan-import-type AnalyticsEventShape from \ChunkifyAnalytics\Events\AnalyticsEvent
 *
 * @phpstan-type EventIngestParamsShape = array{
 *   event: AnalyticsEventShape,
 *   contentEncoding?: null|ContentEncoding|value-of<ContentEncoding>,
 *   origin?: string|null,
 * }
 */
final class EventIngestParams implements BaseModel
{
    /** @use SdkModel<EventIngestParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * A schema version 1 playback event. Extra properties are preserved.
     *
     * @var AnalyticsEventVariants $event
     */
    #[Required]
    public ViewStarted|ViewSnapshot|PlaybackError|ViewEnded|PlaybackStateChanged|RenditionChanged|SeekCompleted $event;

    /** @var value-of<ContentEncoding>|null $contentEncoding */
    #[Optional(enum: ContentEncoding::class)]
    public ?string $contentEncoding;

    #[Optional]
    public ?string $origin;

    /**
     * `new EventIngestParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * EventIngestParams::with(event: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new EventIngestParams)->withEvent(...)
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
     * @param AnalyticsEventShape $event
     * @param ContentEncoding|value-of<ContentEncoding>|null $contentEncoding
     */
    public static function with(
        ViewStarted|array|ViewSnapshot|PlaybackError|ViewEnded|PlaybackStateChanged|RenditionChanged|SeekCompleted $event,
        ContentEncoding|string|null $contentEncoding = null,
        ?string $origin = null,
    ): self {
        $self = new self;

        $self['event'] = $event;

        null !== $contentEncoding && $self['contentEncoding'] = $contentEncoding;
        null !== $origin && $self['origin'] = $origin;

        return $self;
    }

    /**
     * A schema version 1 playback event. Extra properties are preserved.
     *
     * @param AnalyticsEventShape $event
     */
    public function withEvent(
        ViewStarted|array|ViewSnapshot|PlaybackError|ViewEnded|PlaybackStateChanged|RenditionChanged|SeekCompleted $event,
    ): self {
        $self = clone $this;
        $self['event'] = $event;

        return $self;
    }

    /**
     * @param ContentEncoding|value-of<ContentEncoding> $contentEncoding
     */
    public function withContentEncoding(
        ContentEncoding|string $contentEncoding
    ): self {
        $self = clone $this;
        $self['contentEncoding'] = $contentEncoding;

        return $self;
    }

    public function withOrigin(string $origin): self
    {
        $self = clone $this;
        $self['origin'] = $origin;

        return $self;
    }
}
