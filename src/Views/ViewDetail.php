<?php

declare(strict_types=1);

namespace ChunkifyAnalytics\Views;

use ChunkifyAnalytics\Core\Attributes\Required;
use ChunkifyAnalytics\Core\Concerns\SdkModel;
use ChunkifyAnalytics\Core\Contracts\BaseModel;
use ChunkifyAnalytics\Events\StoredEvent;

/**
 * @phpstan-import-type ViewShape from \ChunkifyAnalytics\Views\View
 *
 * @phpstan-type ViewDetailShape = array{
 *   events: list<mixed>, nextCursor: string|null, view: View|ViewShape
 * }
 */
final class ViewDetail implements BaseModel
{
    /** @use SdkModel<ViewDetailShape> */
    use SdkModel;

    /** @var list<mixed> $events */
    #[Required(list: StoredEvent::class)]
    public array $events;

    #[Required('next_cursor')]
    public ?string $nextCursor;

    #[Required]
    public View $view;

    /**
     * `new ViewDetail()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ViewDetail::with(events: ..., nextCursor: ..., view: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ViewDetail)->withEvents(...)->withNextCursor(...)->withView(...)
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
     * @param View|ViewShape $view
     */
    public static function with(
        array $events,
        ?string $nextCursor,
        View|array $view
    ): self {
        $self = new self;

        $self['events'] = $events;
        $self['nextCursor'] = $nextCursor;
        $self['view'] = $view;

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

    /**
     * @param View|ViewShape $view
     */
    public function withView(View|array $view): self
    {
        $self = clone $this;
        $self['view'] = $view;

        return $self;
    }
}
