<?php

declare(strict_types=1);

namespace ChunkifyAnalytics\Quality;

use ChunkifyAnalytics\Core\Attributes\Required;
use ChunkifyAnalytics\Core\Concerns\SdkModel;
use ChunkifyAnalytics\Core\Contracts\BaseModel;
use ChunkifyAnalytics\Quality\QualityBreakdownPage\Group;
use ChunkifyAnalytics\Quality\QualityBreakdownPage\GroupBy;

/**
 * @phpstan-import-type GroupShape from \ChunkifyAnalytics\Quality\QualityBreakdownPage\Group
 *
 * @phpstan-type QualityBreakdownPageShape = array{
 *   groupBy: string|GroupBy|value-of<GroupBy>,
 *   groups: list<Group|GroupShape>,
 *   nextCursor: string|null,
 * }
 */
final class QualityBreakdownPage implements BaseModel
{
    /** @use SdkModel<QualityBreakdownPageShape> */
    use SdkModel;

    /**
     * A custom dimension key, such as custom.plan.
     *
     * @var string|value-of<GroupBy> $groupBy
     */
    #[Required('group_by', enum: GroupBy::class)]
    public string $groupBy;

    /** @var list<Group> $groups */
    #[Required(list: Group::class)]
    public array $groups;

    #[Required('next_cursor')]
    public ?string $nextCursor;

    /**
     * `new QualityBreakdownPage()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * QualityBreakdownPage::with(groupBy: ..., groups: ..., nextCursor: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new QualityBreakdownPage)
     *   ->withGroupBy(...)
     *   ->withGroups(...)
     *   ->withNextCursor(...)
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
     * @param string|GroupBy|value-of<GroupBy> $groupBy
     * @param list<Group|GroupShape> $groups
     */
    public static function with(
        GroupBy|string $groupBy,
        array $groups,
        ?string $nextCursor
    ): self {
        $self = new self;

        $self['groupBy'] = $groupBy;
        $self['groups'] = $groups;
        $self['nextCursor'] = $nextCursor;

        return $self;
    }

    /**
     * A custom dimension key, such as custom.plan.
     *
     * @param string|GroupBy|value-of<GroupBy> $groupBy
     */
    public function withGroupBy(GroupBy|string $groupBy): self
    {
        $self = clone $this;
        $self['groupBy'] = $groupBy;

        return $self;
    }

    /**
     * @param list<Group|GroupShape> $groups
     */
    public function withGroups(array $groups): self
    {
        $self = clone $this;
        $self['groups'] = $groups;

        return $self;
    }

    public function withNextCursor(?string $nextCursor): self
    {
        $self = clone $this;
        $self['nextCursor'] = $nextCursor;

        return $self;
    }
}
