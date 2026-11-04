<?php

declare(strict_types=1);

namespace ChunkifyAnalytics\Summary\MetricsBreakdownPage;

use ChunkifyAnalytics\Core\Attributes\Required;
use ChunkifyAnalytics\Core\Concerns\SdkModel;
use ChunkifyAnalytics\Core\Contracts\BaseModel;
use ChunkifyAnalytics\Summary\Metrics;

/**
 * @phpstan-import-type MetricsShape from \ChunkifyAnalytics\Summary\Metrics
 *
 * @phpstan-type GroupShape = array{data: Metrics|MetricsShape, value: string|null}
 */
final class Group implements BaseModel
{
    /** @use SdkModel<GroupShape> */
    use SdkModel;

    #[Required]
    public Metrics $data;

    #[Required]
    public ?string $value;

    /**
     * `new Group()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Group::with(data: ..., value: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Group)->withData(...)->withValue(...)
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
     * @param Metrics|MetricsShape $data
     */
    public static function with(Metrics|array $data, ?string $value): self
    {
        $self = new self;

        $self['data'] = $data;
        $self['value'] = $value;

        return $self;
    }

    /**
     * @param Metrics|MetricsShape $data
     */
    public function withData(Metrics|array $data): self
    {
        $self = clone $this;
        $self['data'] = $data;

        return $self;
    }

    public function withValue(?string $value): self
    {
        $self = clone $this;
        $self['value'] = $value;

        return $self;
    }
}
