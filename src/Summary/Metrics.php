<?php

declare(strict_types=1);

namespace ChunkifyAnalytics\Summary;

use ChunkifyAnalytics\Core\Attributes\Required;
use ChunkifyAnalytics\Core\Concerns\SdkModel;
use ChunkifyAnalytics\Core\Contracts\BaseModel;

/**
 * @phpstan-type MetricsShape = array{
 *   totalPlayingTimeMs: float, uniqueViewers: int, views: int
 * }
 */
final class Metrics implements BaseModel
{
    /** @use SdkModel<MetricsShape> */
    use SdkModel;

    #[Required('total_playing_time_ms')]
    public float $totalPlayingTimeMs;

    #[Required('unique_viewers')]
    public int $uniqueViewers;

    #[Required]
    public int $views;

    /**
     * `new Metrics()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Metrics::with(totalPlayingTimeMs: ..., uniqueViewers: ..., views: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Metrics)
     *   ->withTotalPlayingTimeMs(...)
     *   ->withUniqueViewers(...)
     *   ->withViews(...)
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
    public static function with(
        float $totalPlayingTimeMs,
        int $uniqueViewers,
        int $views
    ): self {
        $self = new self;

        $self['totalPlayingTimeMs'] = $totalPlayingTimeMs;
        $self['uniqueViewers'] = $uniqueViewers;
        $self['views'] = $views;

        return $self;
    }

    public function withTotalPlayingTimeMs(float $totalPlayingTimeMs): self
    {
        $self = clone $this;
        $self['totalPlayingTimeMs'] = $totalPlayingTimeMs;

        return $self;
    }

    public function withUniqueViewers(int $uniqueViewers): self
    {
        $self = clone $this;
        $self['uniqueViewers'] = $uniqueViewers;

        return $self;
    }

    public function withViews(int $views): self
    {
        $self = clone $this;
        $self['views'] = $views;

        return $self;
    }
}
