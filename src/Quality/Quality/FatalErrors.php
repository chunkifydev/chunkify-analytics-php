<?php

declare(strict_types=1);

namespace ChunkifyAnalytics\Quality\Quality;

use ChunkifyAnalytics\Core\Attributes\Required;
use ChunkifyAnalytics\Core\Concerns\SdkModel;
use ChunkifyAnalytics\Core\Contracts\BaseModel;

/**
 * Observed fatal errors. Lost events can undercount this metric; absence of an error is not proof of successful playback.
 *
 * @phpstan-type FatalErrorsShape = array{affectedViews: int, ratio: float|null}
 */
final class FatalErrors implements BaseModel
{
    /** @use SdkModel<FatalErrorsShape> */
    use SdkModel;

    /**
     * Distinct selected views with at least one observed matching fatal playback_error, including before playback starts.
     */
    #[Required('affected_views')]
    public int $affectedViews;

    /**
     * Affected views divided by all selected attempts; null when views is zero. Multiply by 100 for percent.
     */
    #[Required]
    public ?float $ratio;

    /**
     * `new FatalErrors()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * FatalErrors::with(affectedViews: ..., ratio: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new FatalErrors)->withAffectedViews(...)->withRatio(...)
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
    public static function with(int $affectedViews, ?float $ratio): self
    {
        $self = new self;

        $self['affectedViews'] = $affectedViews;
        $self['ratio'] = $ratio;

        return $self;
    }

    /**
     * Distinct selected views with at least one observed matching fatal playback_error, including before playback starts.
     */
    public function withAffectedViews(int $affectedViews): self
    {
        $self = clone $this;
        $self['affectedViews'] = $affectedViews;

        return $self;
    }

    /**
     * Affected views divided by all selected attempts; null when views is zero. Multiply by 100 for percent.
     */
    public function withRatio(?float $ratio): self
    {
        $self = clone $this;
        $self['ratio'] = $ratio;

        return $self;
    }
}
