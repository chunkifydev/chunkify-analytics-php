<?php

declare(strict_types=1);

namespace ChunkifyAnalytics\Retention;

use ChunkifyAnalytics\Core\Attributes\Required;
use ChunkifyAnalytics\Core\Concerns\SdkModel;
use ChunkifyAnalytics\Core\Contracts\BaseModel;

/**
 * @phpstan-type RetentionBucketShape = array{
 *   endSeconds: float, ratio: float, startSeconds: float, views: int
 * }
 */
final class RetentionBucket implements BaseModel
{
    /** @use SdkModel<RetentionBucketShape> */
    use SdkModel;

    /**
     * Exclusive end of the section, capped at the reported duration.
     */
    #[Required('end_seconds')]
    public float $endSeconds;

    /**
     * views divided by sample_views.
     */
    #[Required]
    public float $ratio;

    /**
     * Inclusive start of the video section.
     */
    #[Required('start_seconds')]
    public float $startSeconds;

    /**
     * Distinct attempts that played any part of this section. Each attempt counts at most once.
     */
    #[Required]
    public int $views;

    /**
     * `new RetentionBucket()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * RetentionBucket::with(
     *   endSeconds: ..., ratio: ..., startSeconds: ..., views: ...
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new RetentionBucket)
     *   ->withEndSeconds(...)
     *   ->withRatio(...)
     *   ->withStartSeconds(...)
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
        float $endSeconds,
        float $ratio,
        float $startSeconds,
        int $views
    ): self {
        $self = new self;

        $self['endSeconds'] = $endSeconds;
        $self['ratio'] = $ratio;
        $self['startSeconds'] = $startSeconds;
        $self['views'] = $views;

        return $self;
    }

    /**
     * Exclusive end of the section, capped at the reported duration.
     */
    public function withEndSeconds(float $endSeconds): self
    {
        $self = clone $this;
        $self['endSeconds'] = $endSeconds;

        return $self;
    }

    /**
     * views divided by sample_views.
     */
    public function withRatio(float $ratio): self
    {
        $self = clone $this;
        $self['ratio'] = $ratio;

        return $self;
    }

    /**
     * Inclusive start of the video section.
     */
    public function withStartSeconds(float $startSeconds): self
    {
        $self = clone $this;
        $self['startSeconds'] = $startSeconds;

        return $self;
    }

    /**
     * Distinct attempts that played any part of this section. Each attempt counts at most once.
     */
    public function withViews(int $views): self
    {
        $self = clone $this;
        $self['views'] = $views;

        return $self;
    }
}
