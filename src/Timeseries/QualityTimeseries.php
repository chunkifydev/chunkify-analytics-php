<?php

declare(strict_types=1);

namespace ChunkifyAnalytics\Timeseries;

use ChunkifyAnalytics\Core\Attributes\Required;
use ChunkifyAnalytics\Core\Concerns\SdkModel;
use ChunkifyAnalytics\Core\Contracts\BaseModel;
use ChunkifyAnalytics\Timeseries\QualityTimeseries\Interval;

/**
 * @phpstan-import-type QualityTimeseriesBucketShape from \ChunkifyAnalytics\Timeseries\QualityTimeseriesBucket
 *
 * @phpstan-type QualityTimeseriesShape = array{
 *   buckets: list<QualityTimeseriesBucket|QualityTimeseriesBucketShape>,
 *   from: \DateTimeInterface,
 *   interval: Interval|value-of<Interval>,
 *   kind: 'quality',
 *   timezone: 'UTC',
 *   to: \DateTimeInterface,
 * }
 */
final class QualityTimeseries implements BaseModel
{
    /** @use SdkModel<QualityTimeseriesShape> */
    use SdkModel;

    /** @var 'quality' $kind */
    #[Required]
    public string $kind = 'quality';

    /** @var 'UTC' $timezone */
    #[Required]
    public string $timezone = 'UTC';

    /** @var list<QualityTimeseriesBucket> $buckets */
    #[Required(list: QualityTimeseriesBucket::class)]
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
     * `new QualityTimeseries()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * QualityTimeseries::with(buckets: ..., from: ..., interval: ..., to: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new QualityTimeseries)
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
     * @param list<QualityTimeseriesBucket|QualityTimeseriesBucketShape> $buckets
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
     * @param list<QualityTimeseriesBucket|QualityTimeseriesBucketShape> $buckets
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
     * @param 'quality' $kind
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
