<?php

declare(strict_types=1);

namespace ChunkifyAnalytics\Events;

use ChunkifyAnalytics\Core\Attributes\Optional;
use ChunkifyAnalytics\Core\Attributes\Required;
use ChunkifyAnalytics\Core\Concerns\SdkModel;
use ChunkifyAnalytics\Core\Contracts\BaseModel;
use ChunkifyAnalytics\EventContext;
use ChunkifyAnalytics\StoredOtlpContext;

/**
 * @phpstan-import-type AnalyticsEventVariants from \ChunkifyAnalytics\Events\AnalyticsEvent
 * @phpstan-import-type AnalyticsEventShape from \ChunkifyAnalytics\Events\AnalyticsEvent
 * @phpstan-import-type EventContextShape from \ChunkifyAnalytics\EventContext
 * @phpstan-import-type StoredOtlpContextShape from \ChunkifyAnalytics\StoredOtlpContext
 *
 * @phpstan-type StoredEventShape = array{
 *   event: AnalyticsEventShape,
 *   ingestKeyID: string|null,
 *   projectID: string,
 *   receivedAt: \DateTimeInterface,
 *   eventContext?: null|EventContext|EventContextShape,
 *   otlp?: null|StoredOtlpContext|StoredOtlpContextShape,
 * }
 */
final class StoredEvent implements BaseModel
{
    /** @use SdkModel<StoredEventShape> */
    use SdkModel;

    /**
     * A schema version 1 playback event. Extra properties are preserved.
     *
     * @var AnalyticsEventVariants $event
     */
    #[Required(union: AnalyticsEvent::class)]
    public ViewStarted|ViewSnapshot|PlaybackError|ViewEnded|PlaybackStateChanged|RenditionChanged|SeekCompleted|SubtitleChanged|PlaybackRateChanged $event;

    /**
     * ID of the public key used to receive this event. Null when unavailable.
     */
    #[Required('ingest_key_id')]
    public ?string $ingestKeyID;

    /**
     * Trusted project identifier resolved from the public key. Historical events migrate to default.
     */
    #[Required('project_id')]
    public string $projectID;

    #[Required('received_at')]
    public \DateTimeInterface $receivedAt;

    /**
     * Browser context and locally derived continent/country/city. Request IP addresses are never added to events or stored context.
     */
    #[Optional('event_context')]
    public ?EventContext $eventContext;

    /**
     * Legacy context present for an event received through OTLP by an earlier collector version. Existing context remains readable; new ingestion accepts native JSON events only.
     */
    #[Optional]
    public ?StoredOtlpContext $otlp;

    /**
     * `new StoredEvent()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * StoredEvent::with(event: ..., ingestKeyID: ..., projectID: ..., receivedAt: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new StoredEvent)
     *   ->withEvent(...)
     *   ->withIngestKeyID(...)
     *   ->withProjectID(...)
     *   ->withReceivedAt(...)
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
     * @param EventContext|EventContextShape|null $eventContext
     * @param StoredOtlpContext|StoredOtlpContextShape|null $otlp
     */
    public static function with(
        ViewStarted|array|ViewSnapshot|PlaybackError|ViewEnded|PlaybackStateChanged|RenditionChanged|SeekCompleted|SubtitleChanged|PlaybackRateChanged $event,
        ?string $ingestKeyID,
        string $projectID,
        \DateTimeInterface $receivedAt,
        EventContext|array|null $eventContext = null,
        StoredOtlpContext|array|null $otlp = null,
    ): self {
        $self = new self;

        $self['event'] = $event;
        $self['ingestKeyID'] = $ingestKeyID;
        $self['projectID'] = $projectID;
        $self['receivedAt'] = $receivedAt;

        null !== $eventContext && $self['eventContext'] = $eventContext;
        null !== $otlp && $self['otlp'] = $otlp;

        return $self;
    }

    /**
     * A schema version 1 playback event. Extra properties are preserved.
     *
     * @param AnalyticsEventShape $event
     */
    public function withEvent(
        ViewStarted|array|ViewSnapshot|PlaybackError|ViewEnded|PlaybackStateChanged|RenditionChanged|SeekCompleted|SubtitleChanged|PlaybackRateChanged $event,
    ): self {
        $self = clone $this;
        $self['event'] = $event;

        return $self;
    }

    /**
     * ID of the public key used to receive this event. Null when unavailable.
     */
    public function withIngestKeyID(?string $ingestKeyID): self
    {
        $self = clone $this;
        $self['ingestKeyID'] = $ingestKeyID;

        return $self;
    }

    /**
     * Trusted project identifier resolved from the public key. Historical events migrate to default.
     */
    public function withProjectID(string $projectID): self
    {
        $self = clone $this;
        $self['projectID'] = $projectID;

        return $self;
    }

    public function withReceivedAt(\DateTimeInterface $receivedAt): self
    {
        $self = clone $this;
        $self['receivedAt'] = $receivedAt;

        return $self;
    }

    /**
     * Browser context and locally derived continent/country/city. Request IP addresses are never added to events or stored context.
     *
     * @param EventContext|EventContextShape $eventContext
     */
    public function withEventContext(EventContext|array $eventContext): self
    {
        $self = clone $this;
        $self['eventContext'] = $eventContext;

        return $self;
    }

    /**
     * Legacy context present for an event received through OTLP by an earlier collector version. Existing context remains readable; new ingestion accepts native JSON events only.
     *
     * @param StoredOtlpContext|StoredOtlpContextShape $otlp
     */
    public function withOtlp(StoredOtlpContext|array $otlp): self
    {
        $self = clone $this;
        $self['otlp'] = $otlp;

        return $self;
    }
}
