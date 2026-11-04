<?php

declare(strict_types=1);

namespace ChunkifyAnalytics\Project;

use ChunkifyAnalytics\Core\Attributes\Optional;
use ChunkifyAnalytics\Core\Attributes\Required;
use ChunkifyAnalytics\Core\Concerns\SdkModel;
use ChunkifyAnalytics\Core\Contracts\BaseModel;
use ChunkifyAnalytics\Core\Conversion\EnumOf;
use ChunkifyAnalytics\Project\CreatedProjectKey\Permission;

/**
 * A newly created key. Save the key value now; later key listings contain only metadata.
 *
 * @phpstan-type CreatedProjectKeyShape = array{
 *   key: string,
 *   keyID: string,
 *   permission: Permission|value-of<Permission>,
 *   projectID: string,
 *   readOnly: bool,
 *   restartRequired: false,
 *   warning?: string|null,
 * }
 */
final class CreatedProjectKey implements BaseModel
{
    /** @use SdkModel<CreatedProjectKeyShape> */
    use SdkModel;

    /** @var false $restartRequired */
    #[Required('restart_required', type: new EnumOf([false]))]
    public bool $restartRequired = false;

    /**
     * New key value. Save it now; it is returned once.
     */
    #[Required]
    public string $key;

    #[Required('key_id')]
    public string $keyID;

    /** @var value-of<Permission> $permission */
    #[Required(enum: Permission::class)]
    public string $permission;

    #[Required('project_id')]
    public string $projectID;

    /**
     * True for a private key limited to analytics reads through HTTP and MCP. Public keys always report false. Rotation preserves this setting.
     */
    #[Required('read_only')]
    public bool $readOnly;

    #[Optional]
    public ?string $warning;

    /**
     * `new CreatedProjectKey()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * CreatedProjectKey::with(
     *   key: ..., keyID: ..., permission: ..., projectID: ..., readOnly: ...
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new CreatedProjectKey)
     *   ->withKey(...)
     *   ->withKeyID(...)
     *   ->withPermission(...)
     *   ->withProjectID(...)
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
        string $key,
        string $keyID,
        Permission|string $permission,
        string $projectID,
        bool $readOnly,
        ?string $warning = null,
    ): self {
        $self = new self;

        $self['key'] = $key;
        $self['keyID'] = $keyID;
        $self['permission'] = $permission;
        $self['projectID'] = $projectID;
        $self['readOnly'] = $readOnly;

        null !== $warning && $self['warning'] = $warning;

        return $self;
    }

    /**
     * New key value. Save it now; it is returned once.
     */
    public function withKey(string $key): self
    {
        $self = clone $this;
        $self['key'] = $key;

        return $self;
    }

    public function withKeyID(string $keyID): self
    {
        $self = clone $this;
        $self['keyID'] = $keyID;

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

    public function withProjectID(string $projectID): self
    {
        $self = clone $this;
        $self['projectID'] = $projectID;

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
