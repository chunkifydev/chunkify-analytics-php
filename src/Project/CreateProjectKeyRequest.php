<?php

declare(strict_types=1);

namespace ChunkifyAnalytics\Project;

use ChunkifyAnalytics\Core\Attributes\Optional;
use ChunkifyAnalytics\Core\Attributes\Required;
use ChunkifyAnalytics\Core\Concerns\SdkModel;
use ChunkifyAnalytics\Core\Contracts\BaseModel;
use ChunkifyAnalytics\Project\CreateProjectKeyRequest\Permission;

/**
 * @phpstan-type CreateProjectKeyRequestShape = array{
 *   name: string,
 *   permission: Permission|value-of<Permission>,
 *   readOnly?: bool|null,
 * }
 */
final class CreateProjectKeyRequest implements BaseModel
{
    /** @use SdkModel<CreateProjectKeyRequestShape> */
    use SdkModel;

    /**
     * Key display name, up to 128 UTF-8 bytes. Whitespace-only names are rejected.
     */
    #[Required]
    public string $name;

    /** @var value-of<Permission> $permission */
    #[Required(enum: Permission::class)]
    public string $permission;

    /**
     * Only secret keys can be read-only. False grants full project management access to secret keys; public keys only ingest events.
     */
    #[Optional('read_only')]
    public ?bool $readOnly;

    /**
     * `new CreateProjectKeyRequest()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * CreateProjectKeyRequest::with(name: ..., permission: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new CreateProjectKeyRequest)->withName(...)->withPermission(...)
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
        string $name,
        Permission|string $permission,
        ?bool $readOnly = null
    ): self {
        $self = new self;

        $self['name'] = $name;
        $self['permission'] = $permission;

        null !== $readOnly && $self['readOnly'] = $readOnly;

        return $self;
    }

    /**
     * Key display name, up to 128 UTF-8 bytes. Whitespace-only names are rejected.
     */
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
     * Only secret keys can be read-only. False grants full project management access to secret keys; public keys only ingest events.
     */
    public function withReadOnly(bool $readOnly): self
    {
        $self = clone $this;
        $self['readOnly'] = $readOnly;

        return $self;
    }
}
