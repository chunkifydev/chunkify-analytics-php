<?php

declare(strict_types=1);

namespace ChunkifyAnalytics\WatchTimeDistribution;

use ChunkifyAnalytics\Core\Attributes\Required;
use ChunkifyAnalytics\Core\Concerns\SdkModel;
use ChunkifyAnalytics\Core\Contracts\BaseModel;

/**
 * Mutually exclusive playing-time buckets: [0,10s), [10s,30s), [30s,60s), [1m,5m), [5m,infinity). Counts sum to sample_views.
 *
 * @phpstan-type DistributionShape = array{
 *   atLeast5Minutes: int,
 *   from1To5Minutes: int,
 *   from10To30Seconds: int,
 *   from30To60Seconds: int,
 *   under10Seconds: int,
 * }
 */
final class Distribution implements BaseModel
{
    /** @use SdkModel<DistributionShape> */
    use SdkModel;

    #[Required('at_least_5_minutes')]
    public int $atLeast5Minutes;

    #[Required('from_1_to_5_minutes')]
    public int $from1To5Minutes;

    #[Required('from_10_to_30_seconds')]
    public int $from10To30Seconds;

    #[Required('from_30_to_60_seconds')]
    public int $from30To60Seconds;

    #[Required('under_10_seconds')]
    public int $under10Seconds;

    /**
     * `new Distribution()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Distribution::with(
     *   atLeast5Minutes: ...,
     *   from1To5Minutes: ...,
     *   from10To30Seconds: ...,
     *   from30To60Seconds: ...,
     *   under10Seconds: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Distribution)
     *   ->withAtLeast5Minutes(...)
     *   ->withFrom1To5Minutes(...)
     *   ->withFrom10To30Seconds(...)
     *   ->withFrom30To60Seconds(...)
     *   ->withUnder10Seconds(...)
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
        int $atLeast5Minutes,
        int $from1To5Minutes,
        int $from10To30Seconds,
        int $from30To60Seconds,
        int $under10Seconds,
    ): self {
        $self = new self;

        $self['atLeast5Minutes'] = $atLeast5Minutes;
        $self['from1To5Minutes'] = $from1To5Minutes;
        $self['from10To30Seconds'] = $from10To30Seconds;
        $self['from30To60Seconds'] = $from30To60Seconds;
        $self['under10Seconds'] = $under10Seconds;

        return $self;
    }

    public function withAtLeast5Minutes(int $atLeast5Minutes): self
    {
        $self = clone $this;
        $self['atLeast5Minutes'] = $atLeast5Minutes;

        return $self;
    }

    public function withFrom1To5Minutes(int $from1To5Minutes): self
    {
        $self = clone $this;
        $self['from1To5Minutes'] = $from1To5Minutes;

        return $self;
    }

    public function withFrom10To30Seconds(int $from10To30Seconds): self
    {
        $self = clone $this;
        $self['from10To30Seconds'] = $from10To30Seconds;

        return $self;
    }

    public function withFrom30To60Seconds(int $from30To60Seconds): self
    {
        $self = clone $this;
        $self['from30To60Seconds'] = $from30To60Seconds;

        return $self;
    }

    public function withUnder10Seconds(int $under10Seconds): self
    {
        $self = clone $this;
        $self['under10Seconds'] = $under10Seconds;

        return $self;
    }
}
