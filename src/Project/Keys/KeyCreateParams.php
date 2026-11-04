<?php

declare(strict_types=1);

namespace ChunkifyAnalytics\Project\Keys;

use ChunkifyAnalytics\Core\Attributes\Optional;
use ChunkifyAnalytics\Core\Attributes\Required;
use ChunkifyAnalytics\Core\Concerns\SdkModel;
use ChunkifyAnalytics\Core\Concerns\SdkParams;
use ChunkifyAnalytics\Core\Contracts\BaseModel;
use ChunkifyAnalytics\Project\Keys\KeyCreateParams\Permission;

/**
 * Create a named public ingestion key or secret key in the authenticated project. Secret keys default to full project access; set read_only to true for analytics reads and exports only. Requires a full-access project secret key. Read-only keys receive 403 and the installation admin key is not accepted. The key is active immediately and its value is returned once; store it before leaving this response. Each project supports at most 64 active keys, including its initial keys.
 *
 * @see ChunkifyAnalytics\Services\Project\KeysService::create()
 *
 * @phpstan-type KeyCreateParamsShape = array{
 *   name: string,
 *   permission: Permission|value-of<Permission>,
 *   readOnly?: bool|null,
 * }
 */
final class KeyCreateParams implements BaseModel
{
    /** @use SdkModel<KeyCreateParamsShape> */
    use SdkModel;
    use SdkParams;

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
     * `new KeyCreateParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * KeyCreateParams::with(name: ..., permission: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new KeyCreateParams)->withName(...)->withPermission(...)
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
