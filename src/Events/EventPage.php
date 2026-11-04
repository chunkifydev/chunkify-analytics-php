<?php

declare(strict_types=1);

namespace ChunkifyAnalytics\Events;

use ChunkifyAnalytics\Core\Attributes\Required;
use ChunkifyAnalytics\Core\Concerns\SdkModel;
use ChunkifyAnalytics\Core\Contracts\BaseModel;

/**
 * @phpstan-type EventPageShape = array{
 *   events: list<mixed>, nextCursor: string|null
 * }
 */
final class EventPage implements BaseModel
{
    /** @use SdkModel<EventPageShape> */
    use SdkModel;

    /** @var list<mixed> $events */
    #[Required(list: StoredEvent::class)]
    public array $events;

    #[Required('next_cursor')]
    public ?string $nextCursor;

    /**
     * `new EventPage()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * EventPage::with(events: ..., nextCursor: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new EventPage)->withEvents(...)->withNextCursor(...)
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
     * @param list<mixed> $events
     */
    public static function with(array $events, ?string $nextCursor): self
    {
        $self = new self;

        $self['events'] = $events;
        $self['nextCursor'] = $nextCursor;

        return $self;
    }

    /**
     * @param list<mixed> $events
     */
    public function withEvents(array $events): self
    {
        $self = clone $this;
        $self['events'] = $events;

        return $self;
    }

    public function withNextCursor(?string $nextCursor): self
    {
        $self = clone $this;
        $self['nextCursor'] = $nextCursor;

        return $self;
    }
}
