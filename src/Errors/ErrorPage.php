<?php

declare(strict_types=1);

namespace ChunkifyAnalytics\Errors;

use ChunkifyAnalytics\Core\Attributes\Required;
use ChunkifyAnalytics\Core\Concerns\SdkModel;
use ChunkifyAnalytics\Core\Contracts\BaseModel;

/**
 * @phpstan-import-type ErrorGroupShape from \ChunkifyAnalytics\Errors\ErrorGroup
 *
 * @phpstan-type ErrorPageShape = array{
 *   errors: list<ErrorGroup|ErrorGroupShape>, nextCursor: string|null
 * }
 */
final class ErrorPage implements BaseModel
{
    /** @use SdkModel<ErrorPageShape> */
    use SdkModel;

    /** @var list<ErrorGroup> $errors */
    #[Required(list: ErrorGroup::class)]
    public array $errors;

    #[Required('next_cursor')]
    public ?string $nextCursor;

    /**
     * `new ErrorPage()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ErrorPage::with(errors: ..., nextCursor: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ErrorPage)->withErrors(...)->withNextCursor(...)
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
     * @param list<ErrorGroup|ErrorGroupShape> $errors
     */
    public static function with(array $errors, ?string $nextCursor): self
    {
        $self = new self;

        $self['errors'] = $errors;
        $self['nextCursor'] = $nextCursor;

        return $self;
    }

    /**
     * @param list<ErrorGroup|ErrorGroupShape> $errors
     */
    public function withErrors(array $errors): self
    {
        $self = clone $this;
        $self['errors'] = $errors;

        return $self;
    }

    public function withNextCursor(?string $nextCursor): self
    {
        $self = clone $this;
        $self['nextCursor'] = $nextCursor;

        return $self;
    }
}
