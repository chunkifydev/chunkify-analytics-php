<?php

declare(strict_types=1);

namespace ChunkifyAnalytics\Project;

use ChunkifyAnalytics\Core\Attributes\Required;
use ChunkifyAnalytics\Core\Concerns\SdkModel;
use ChunkifyAnalytics\Core\Contracts\BaseModel;

/**
 * @phpstan-import-type ProjectKeyShape from \ChunkifyAnalytics\Project\ProjectKey
 *
 * @phpstan-type ProjectKeysShape = array{
 *   keys: list<ProjectKey|ProjectKeyShape>, projectID: string
 * }
 */
final class ProjectKeys implements BaseModel
{
    /** @use SdkModel<ProjectKeysShape> */
    use SdkModel;

    /** @var list<ProjectKey> $keys */
    #[Required(list: ProjectKey::class)]
    public array $keys;

    #[Required('project_id')]
    public string $projectID;

    /**
     * `new ProjectKeys()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ProjectKeys::with(keys: ..., projectID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ProjectKeys)->withKeys(...)->withProjectID(...)
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
     * @param list<ProjectKey|ProjectKeyShape> $keys
     */
    public static function with(array $keys, string $projectID): self
    {
        $self = new self;

        $self['keys'] = $keys;
        $self['projectID'] = $projectID;

        return $self;
    }

    /**
     * @param list<ProjectKey|ProjectKeyShape> $keys
     */
    public function withKeys(array $keys): self
    {
        $self = clone $this;
        $self['keys'] = $keys;

        return $self;
    }

    public function withProjectID(string $projectID): self
    {
        $self = clone $this;
        $self['projectID'] = $projectID;

        return $self;
    }
}
