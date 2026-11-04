<?php

declare(strict_types=1);

namespace ChunkifyAnalytics\Project;

use ChunkifyAnalytics\Core\Attributes\Optional;
use ChunkifyAnalytics\Core\Attributes\Required;
use ChunkifyAnalytics\Core\Concerns\SdkModel;
use ChunkifyAnalytics\Core\Contracts\BaseModel;
use ChunkifyAnalytics\Core\Conversion\EnumOf;

/**
 * @phpstan-type DeletedProjectShape = array{
 *   deleted: true,
 *   projectID: string,
 *   restartRequired: false,
 *   warning?: string|null,
 * }
 */
final class DeletedProject implements BaseModel
{
    /** @use SdkModel<DeletedProjectShape> */
    use SdkModel;

    /** @var true $deleted */
    #[Required(type: new EnumOf([true]))]
    public bool $deleted = true;

    /** @var false $restartRequired */
    #[Required('restart_required', type: new EnumOf([false]))]
    public bool $restartRequired = false;

    #[Required('project_id')]
    public string $projectID;

    #[Optional]
    public ?string $warning;

    /**
     * `new DeletedProject()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * DeletedProject::with(projectID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new DeletedProject)->withProjectID(...)
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
    public static function with(string $projectID, ?string $warning = null): self
    {
        $self = new self;

        $self['projectID'] = $projectID;

        null !== $warning && $self['warning'] = $warning;

        return $self;
    }

    /**
     * @param true $deleted
     */
    public function withDeleted(bool $deleted): self
    {
        $self = clone $this;
        $self['deleted'] = $deleted;

        return $self;
    }

    public function withProjectID(string $projectID): self
    {
        $self = clone $this;
        $self['projectID'] = $projectID;

        return $self;
    }

    /**
     * @param false $restartRequired
     */
    public function withRestartRequired(bool $restartRequired): self
    {
        $self = clone $this;
        $self['restartRequired'] = $restartRequired;

        return $self;
    }

    public function withWarning(string $warning): self
    {
        $self = clone $this;
        $self['warning'] = $warning;

        return $self;
    }
}
