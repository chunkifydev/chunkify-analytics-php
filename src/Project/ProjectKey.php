<?php

declare(strict_types=1);

namespace ChunkifyAnalytics\Project;

use ChunkifyAnalytics\Core\Attributes\Required;
use ChunkifyAnalytics\Core\Concerns\SdkModel;
use ChunkifyAnalytics\Core\Contracts\BaseModel;
use ChunkifyAnalytics\Project\ProjectKey\Permission;

/**
 * @phpstan-type ProjectKeyShape = array{
 *   id: string,
 *   name: string,
 *   permission: Permission|value-of<Permission>,
 *   readOnly: bool,
 * }
 */
final class ProjectKey implements BaseModel
{
    /** @use SdkModel<ProjectKeyShape> */
    use SdkModel;

    #[Required]
    public string $id;

    #[Required]
    public string $name;

    /** @var value-of<Permission> $permission */
    #[Required(enum: Permission::class)]
    public string $permission;

    /**
     * True for a private key limited to analytics reads through HTTP and MCP. Public keys always report false. Rotation preserves this setting.
     */
    #[Required('read_only')]
    public bool $readOnly;

    /**
     * `new ProjectKey()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ProjectKey::with(id: ..., name: ..., permission: ..., readOnly: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ProjectKey)
     *   ->withID(...)
     *   ->withName(...)
     *   ->withPermission(...)
     *   ->withReadOnly(...)
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
     * @param Permission|value-of<Permission> $permission
     */
    public static function with(
        string $id,
        string $name,
        Permission|string $permission,
        bool $readOnly
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['name'] = $name;
        $self['permission'] = $permission;
        $self['readOnly'] = $readOnly;

        return $self;
    }

    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    public function withName(string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }

    /**
     * @param Permission|value-of<Permission> $permission
     */
    public function withPermission(Permission|string $permission): self
    {
        $self = clone $this;
        $self['permission'] = $permission;

        return $self;
    }

    /**
     * True for a private key limited to analytics reads through HTTP and MCP. Public keys always report false. Rotation preserves this setting.
     */
    public function withReadOnly(bool $readOnly): self
    {
        $self = clone $this;
        $self['readOnly'] = $readOnly;

        return $self;
    }
}
