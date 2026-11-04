<?php

declare(strict_types=1);

namespace ChunkifyAnalytics\Views;

use ChunkifyAnalytics\Core\Attributes\Required;
use ChunkifyAnalytics\Core\Concerns\SdkModel;
use ChunkifyAnalytics\Core\Contracts\BaseModel;

/**
 * @phpstan-import-type ViewShape from \ChunkifyAnalytics\Views\View
 *
 * @phpstan-type ViewPageShape = array{
 *   nextCursor: string|null, views: list<View|ViewShape>
 * }
 */
final class ViewPage implements BaseModel
{
    /** @use SdkModel<ViewPageShape> */
    use SdkModel;

    #[Required('next_cursor')]
    public ?string $nextCursor;

    /** @var list<View> $views */
    #[Required(list: View::class)]
    public array $views;

    /**
     * `new ViewPage()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ViewPage::with(nextCursor: ..., views: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ViewPage)->withNextCursor(...)->withViews(...)
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
     * @param list<View|ViewShape> $views
     */
    public static function with(?string $nextCursor, array $views): self
    {
        $self = new self;

        $self['nextCursor'] = $nextCursor;
        $self['views'] = $views;

        return $self;
    }

    public function withNextCursor(?string $nextCursor): self
    {
        $self = clone $this;
        $self['nextCursor'] = $nextCursor;

        return $self;
    }

    /**
     * @param list<View|ViewShape> $views
     */
    public function withViews(array $views): self
    {
        $self = clone $this;
        $self['views'] = $views;

        return $self;
    }
}
