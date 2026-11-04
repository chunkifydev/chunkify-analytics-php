<?php

declare(strict_types=1);

namespace ChunkifyAnalytics;

use ChunkifyAnalytics\Core\Attributes\Required;
use ChunkifyAnalytics\Core\Concerns\SdkModel;
use ChunkifyAnalytics\Core\Contracts\BaseModel;

/**
 * View count and fraction of its documented denominator. The ratio is null when that denominator is zero.
 *
 * @phpstan-type MetricCountRatioShape = array{ratio: float|null, views: int}
 */
final class MetricCountRatio implements BaseModel
{
    /** @use SdkModel<MetricCountRatioShape> */
    use SdkModel;

    #[Required]
    public ?float $ratio;

    #[Required]
    public int $views;

    /**
     * `new MetricCountRatio()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * MetricCountRatio::with(ratio: ..., views: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new MetricCountRatio)->withRatio(...)->withViews(...)
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
    public static function with(?float $ratio, int $views): self
    {
        $self = new self;

        $self['ratio'] = $ratio;
        $self['views'] = $views;

        return $self;
    }

    public function withRatio(?float $ratio): self
    {
        $self = clone $this;
        $self['ratio'] = $ratio;

        return $self;
    }

    public function withViews(int $views): self
    {
        $self = clone $this;
        $self['views'] = $views;

        return $self;
    }
}
