<?php

declare(strict_types=1);

namespace ChunkifyAnalytics\Timeseries;

use ChunkifyAnalytics\Core\Attributes\Required;
use ChunkifyAnalytics\Core\Concerns\SdkModel;
use ChunkifyAnalytics\Core\Contracts\BaseModel;
use ChunkifyAnalytics\Timeseries\EngagementTimeseries\Interval;

/**
 * @phpstan-import-type EngagementTimeseriesBucketShape from \ChunkifyAnalytics\Timeseries\EngagementTimeseriesBucket
 *
 * @phpstan-type EngagementTimeseriesShape = array{
 *   buckets: list<EngagementTimeseriesBucket|EngagementTimeseriesBucketShape>,
 *   from: \DateTimeInterface,
 *   interval: Interval|value-of<Interval>,
 *   kind: 'engagement',
 *   timezone: 'UTC',
 *   to: \DateTimeInterface,
 * }
 */
final class EngagementTimeseries implements BaseModel
{
    /** @use SdkModel<EngagementTimeseriesShape> */
    use SdkModel;

    /** @var 'engagement' $kind */
    #[Required]
    public string $kind = 'engagement';

    /** @var 'UTC' $timezone */
    #[Required]
    public string $timezone = 'UTC';

    /** @var list<EngagementTimeseriesBucket> $buckets */
    #[Required(list: EngagementTimeseriesBucket::class)]
    public array $buckets;

    /**
     * Inclusive query bound normalized to UTC milliseconds.
     */
    #[Required]
    public \DateTimeInterface $from;

    /** @var value-of<Interval> $interval */
    #[Required(enum: Interval::class)]
    public string $interval;

    /**
     * Exclusive query bound normalized to UTC milliseconds.
     */
    #[Required]
    public \DateTimeInterface $to;

    /**
     * `new EngagementTimeseries()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * EngagementTimeseries::with(buckets: ..., from: ..., interval: ..., to: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new EngagementTimeseries)
     *   ->withBuckets(...)
     *   ->withFrom(...)
     *   ->withInterval(...)
     *   ->withTo(...)
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
     * @param list<EngagementTimeseriesBucket|EngagementTimeseriesBucketShape> $buckets
     * @param Interval|value-of<Interval> $interval
     */
    public static function with(
        array $buckets,
        \DateTimeInterface $from,
        Interval|string $interval,
        \DateTimeInterface $to,
    ): self {
        $self = new self;

        $self['buckets'] = $buckets;
        $self['from'] = $from;
        $self['interval'] = $interval;
        $self['to'] = $to;

        return $self;
    }

    /**
     * @param list<EngagementTimeseriesBucket|EngagementTimeseriesBucketShape> $buckets
     */
    public function withBuckets(array $buckets): self
    {
        $self = clone $this;
        $self['buckets'] = $buckets;

        return $self;
    }

    /**
     * Inclusive query bound normalized to UTC milliseconds.
     */
    public function withFrom(\DateTimeInterface $from): self
    {
        $self = clone $this;
        $self['from'] = $from;

        return $self;
    }

    /**
     * @param Interval|value-of<Interval> $interval
     */
    public function withInterval(Interval|string $interval): self
    {
        $self = clone $this;
        $self['interval'] = $interval;

        return $self;
    }

    /**
     * @param 'engagement' $kind
     */
    public function withKind(string $kind): self
    {
        $self = clone $this;
        $self['kind'] = $kind;

        return $self;
    }

    /**
     * @param 'UTC' $timezone
     */
    public function withTimezone(string $timezone): self
    {
        $self = clone $this;
        $self['timezone'] = $timezone;

        return $self;
    }

    /**
     * Exclusive query bound normalized to UTC milliseconds.
     */
    public function withTo(\DateTimeInterface $to): self
    {
        $self = clone $this;
        $self['to'] = $to;

        return $self;
    }
}
