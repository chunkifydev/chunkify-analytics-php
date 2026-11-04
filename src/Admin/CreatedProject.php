<?php

declare(strict_types=1);

namespace ChunkifyAnalytics\Admin;

use ChunkifyAnalytics\Core\Attributes\Optional;
use ChunkifyAnalytics\Core\Attributes\Required;
use ChunkifyAnalytics\Core\Concerns\SdkModel;
use ChunkifyAnalytics\Core\Contracts\BaseModel;
use ChunkifyAnalytics\Core\Conversion\EnumOf;

/**
 * @phpstan-type CreatedProjectShape = array{
 *   effectiveRetentionSeconds: int,
 *   name: string,
 *   projectID: string,
 *   publicKey: string,
 *   restartRequired: false,
 *   retentionSeconds: int|null,
 *   secretKey: string,
 *   warning?: string|null,
 * }
 */
final class CreatedProject implements BaseModel
{
    /** @use SdkModel<CreatedProjectShape> */
    use SdkModel;

    /** @var false $restartRequired */
    #[Required('restart_required', type: new EnumOf([false]))]
    public bool $restartRequired = false;

    /**
     * Effective retention in seconds after resolving the installation default. 0 disables expiration.
     */
    #[Required('effective_retention_seconds')]
    public int $effectiveRetentionSeconds;

    /**
     * Project display name.
     */
    #[Required]
    public string $name;

    #[Required('project_id')]
    public string $projectID;

    /**
     * Public key for sending events.
     */
    #[Required('public_key')]
    public string $publicKey;

    /**
     * Retention by server receipt time, in seconds. 0 disables expiration; null inherits the installation default.
     */
    #[Required('retention_seconds')]
    public ?int $retentionSeconds;

    /**
     * Secret key for this project. Save it now; it is returned once.
     */
    #[Required('secret_key')]
    public string $secretKey;

    #[Optional]
    public ?string $warning;

    /**
     * `new CreatedProject()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * CreatedProject::with(
     *   effectiveRetentionSeconds: ...,
     *   name: ...,
     *   projectID: ...,
     *   publicKey: ...,
     *   retentionSeconds: ...,
     *   secretKey: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new CreatedProject)
     *   ->withEffectiveRetentionSeconds(...)
     *   ->withName(...)
     *   ->withProjectID(...)
     *   ->withPublicKey(...)
     *   ->withRetentionSeconds(...)
     *   ->withSecretKey(...)
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
        int $effectiveRetentionSeconds,
        string $name,
        string $projectID,
        string $publicKey,
        ?int $retentionSeconds,
        string $secretKey,
        ?string $warning = null,
    ): self {
        $self = new self;

        $self['effectiveRetentionSeconds'] = $effectiveRetentionSeconds;
        $self['name'] = $name;
        $self['projectID'] = $projectID;
        $self['publicKey'] = $publicKey;
        $self['retentionSeconds'] = $retentionSeconds;
        $self['secretKey'] = $secretKey;

        null !== $warning && $self['warning'] = $warning;

        return $self;
    }

    /**
     * Effective retention in seconds after resolving the installation default. 0 disables expiration.
     */
    public function withEffectiveRetentionSeconds(
        int $effectiveRetentionSeconds
    ): self {
        $self = clone $this;
        $self['effectiveRetentionSeconds'] = $effectiveRetentionSeconds;

        return $self;
    }

    /**
     * Project display name.
     */
    public function withName(string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }

    public function withProjectID(string $projectID): self
    {
        $self = clone $this;
        $self['projectID'] = $projectID;

        return $self;
    }

    /**
     * Public key for sending events.
     */
    public function withPublicKey(string $publicKey): self
    {
        $self = clone $this;
        $self['publicKey'] = $publicKey;

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

    /**
     * Retention by server receipt time, in seconds. 0 disables expiration; null inherits the installation default.
     */
    public function withRetentionSeconds(?int $retentionSeconds): self
    {
        $self = clone $this;
        $self['retentionSeconds'] = $retentionSeconds;

        return $self;
    }

    /**
     * Secret key for this project. Save it now; it is returned once.
     */
    public function withSecretKey(string $secretKey): self
    {
        $self = clone $this;
        $self['secretKey'] = $secretKey;

        return $self;
    }

    public function withWarning(string $warning): self
    {
        $self = clone $this;
        $self['warning'] = $warning;

        return $self;
    }
}
