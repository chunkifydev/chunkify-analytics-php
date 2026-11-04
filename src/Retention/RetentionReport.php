<?php

declare(strict_types=1);

namespace ChunkifyAnalytics\Retention;

use ChunkifyAnalytics\Core\Attributes\Required;
use ChunkifyAnalytics\Core\Concerns\SdkModel;
use ChunkifyAnalytics\Core\Contracts\BaseModel;

/**
 * @phpstan-import-type RetentionBucketShape from \ChunkifyAnalytics\Retention\RetentionBucket
 *
 * @phpstan-type RetentionReportShape = array{
 *   buckets: list<RetentionBucket|RetentionBucketShape>,
 *   durationSeconds: float|null,
 *   intervalSeconds: float|null,
 *   sampleViews: int,
 *   views: int,
 * }
 */
final class RetentionReport implements BaseModel
{
    /** @use SdkModel<RetentionReportShape> */
    use SdkModel;

    /** @var list<RetentionBucket> $buckets */
    #[Required(list: RetentionBucket::class)]
    public array $buckets;

    /**
     * Longest measured duration in this selection. Null when there are no measured attempts.
     */
    #[Required('duration_seconds')]
    public ?float $durationSeconds;

    /**
     * Bucket width, ceil(duration_seconds / 200), with a minimum of one second. Null without measurements.
     */
    #[Required('interval_seconds')]
    public ?float $intervalSeconds;

    /**
     * Attempts whose selected final or latest snapshot contains played ranges and a finite positive media duration. Includes measured empty ranges.
     */
    #[Required('sample_views')]
    public int $sampleViews;

    /**
     * All matching attempts with a retained start.
     */
    #[Required]
    public int $views;

    /**
     * `new RetentionReport()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * RetentionReport::with(
     *   buckets: ...,
     *   durationSeconds: ...,
     *   intervalSeconds: ...,
     *   sampleViews: ...,
     *   views: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new RetentionReport)
     *   ->withBuckets(...)
     *   ->withDurationSeconds(...)
     *   ->withIntervalSeconds(...)
     *   ->withSampleViews(...)
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
     *
     * @param list<RetentionBucket|RetentionBucketShape> $buckets
     */
    public static function with(
        array $buckets,
        ?float $durationSeconds,
        ?float $intervalSeconds,
        int $sampleViews,
        int $views,
    ): self {
        $self = new self;

        $self['buckets'] = $buckets;
        $self['durationSeconds'] = $durationSeconds;
        $self['intervalSeconds'] = $intervalSeconds;
        $self['sampleViews'] = $sampleViews;
        $self['views'] = $views;

        return $self;
    }

    /**
     * @param list<RetentionBucket|RetentionBucketShape> $buckets
     */
    public function withBuckets(array $buckets): self
    {
        $self = clone $this;
        $self['buckets'] = $buckets;

        return $self;
    }

    /**
     * Longest measured duration in this selection. Null when there are no measured attempts.
     */
    public function withDurationSeconds(?float $durationSeconds): self
    {
        $self = clone $this;
        $self['durationSeconds'] = $durationSeconds;

        return $self;
    }

    /**
     * Bucket width, ceil(duration_seconds / 200), with a minimum of one second. Null without measurements.
     */
    public function withIntervalSeconds(?float $intervalSeconds): self
    {
        $self = clone $this;
        $self['intervalSeconds'] = $intervalSeconds;

        return $self;
    }

    /**
     * Attempts whose selected final or latest snapshot contains played ranges and a finite positive media duration. Includes measured empty ranges.
     */
    public function withSampleViews(int $sampleViews): self
    {
        $self = clone $this;
        $self['sampleViews'] = $sampleViews;

        return $self;
    }

    /**
     * All matching attempts with a retained start.
     */
    public function withViews(int $views): self
    {
        $self = clone $this;
        $self['views'] = $views;

        return $self;
    }
}
