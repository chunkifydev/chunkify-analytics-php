<?php

declare(strict_types=1);

namespace ChunkifyAnalytics\Errors;

use ChunkifyAnalytics\Core\Attributes\Required;
use ChunkifyAnalytics\Core\Concerns\SdkModel;
use ChunkifyAnalytics\Core\Contracts\BaseModel;

/**
 * @phpstan-import-type ErrorCodeVariants from \ChunkifyAnalytics\Errors\ErrorGroup\ErrorCode
 * @phpstan-import-type ErrorCodeShape from \ChunkifyAnalytics\Errors\ErrorGroup\ErrorCode
 *
 * @phpstan-type ErrorGroupShape = array{
 *   affectedViews: int,
 *   errorCode: ErrorCodeShape|null,
 *   errorEvents: int,
 *   fatal: bool|null,
 * }
 */
final class ErrorGroup implements BaseModel
{
    /** @use SdkModel<ErrorGroupShape> */
    use SdkModel;

    #[Required('affected_views')]
    public int $affectedViews;

    /** @var ErrorCodeVariants|null $errorCode */
    #[Required('error_code')]
    public string|float|null $errorCode;

    #[Required('error_events')]
    public int $errorEvents;

    #[Required]
    public ?bool $fatal;

    /**
     * `new ErrorGroup()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ErrorGroup::with(
     *   affectedViews: ..., errorCode: ..., errorEvents: ..., fatal: ...
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ErrorGroup)
     *   ->withAffectedViews(...)
     *   ->withErrorCode(...)
     *   ->withErrorEvents(...)
     *   ->withFatal(...)
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
     * @param ErrorCodeShape|null $errorCode
     */
    public static function with(
        int $affectedViews,
        string|float|null $errorCode,
        int $errorEvents,
        ?bool $fatal,
    ): self {
        $self = new self;

        $self['affectedViews'] = $affectedViews;
        $self['errorCode'] = $errorCode;
        $self['errorEvents'] = $errorEvents;
        $self['fatal'] = $fatal;

        return $self;
    }

    public function withAffectedViews(int $affectedViews): self
    {
        $self = clone $this;
        $self['affectedViews'] = $affectedViews;

        return $self;
    }

    /**
     * @param ErrorCodeShape|null $errorCode
     */
    public function withErrorCode(string|float|null $errorCode): self
    {
        $self = clone $this;
        $self['errorCode'] = $errorCode;

        return $self;
    }

    public function withErrorEvents(int $errorEvents): self
    {
        $self = clone $this;
        $self['errorEvents'] = $errorEvents;

        return $self;
    }

    public function withFatal(?bool $fatal): self
    {
        $self = clone $this;
        $self['fatal'] = $fatal;

        return $self;
    }
}
