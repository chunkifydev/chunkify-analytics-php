<?php

declare(strict_types=1);

namespace ChunkifyAnalytics\Engagement\EngagementBreakdownPage;

use ChunkifyAnalytics\Core\Attributes\Required;
use ChunkifyAnalytics\Core\Concerns\SdkModel;
use ChunkifyAnalytics\Core\Contracts\BaseModel;
use ChunkifyAnalytics\Engagement\Engagement;

/**
 * @phpstan-import-type EngagementShape from \ChunkifyAnalytics\Engagement\Engagement
 *
 * @phpstan-type GroupShape = array{
 *   data: Engagement|EngagementShape, value: string|null
 * }
 */
final class Group implements BaseModel
{
    /** @use SdkModel<GroupShape> */
    use SdkModel;

    /**
     * Observed watch time and end-of-media for the same start cohort as summary. Missing delivery can undercount both.
     */
    #[Required]
    public Engagement $data;

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
     * @param Engagement|EngagementShape $data
     */
    public static function with(Engagement|array $data, ?string $value): self
    {
        $self = new self;

        $self['data'] = $data;
        $self['value'] = $value;

        return $self;
    }

    /**
     * Observed watch time and end-of-media for the same start cohort as summary. Missing delivery can undercount both.
     *
     * @param Engagement|EngagementShape $data
     */
    public function withData(Engagement|array $data): self
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
