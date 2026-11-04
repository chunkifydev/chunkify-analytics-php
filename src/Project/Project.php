<?php

declare(strict_types=1);

namespace ChunkifyAnalytics\Project;

use ChunkifyAnalytics\Core\Attributes\Optional;
use ChunkifyAnalytics\Core\Attributes\Required;
use ChunkifyAnalytics\Core\Concerns\SdkModel;
use ChunkifyAnalytics\Core\Contracts\BaseModel;
use ChunkifyAnalytics\Core\Conversion\EnumOf;

/**
 * @phpstan-type ProjectShape = array{
 *   allowedOrigins: list<string>,
 *   effectiveAllowedOrigins: list<string>,
 *   effectiveRetentionSeconds: int,
 *   name: string,
 *   projectID: string,
 *   restartRequired: false,
 *   retentionSeconds: int|null,
 *   warning?: string|null,
 * }
 */
final class Project implements BaseModel
{
    /** @use SdkModel<ProjectShape> */
    use SdkModel;

    /** @var false $restartRequired */
    #[Required('restart_required', type: new EnumOf([false]))]
    public bool $restartRequired = false;

    /** @var list<string> $allowedOrigins */
    #[Required('allowed_origins', list: 'string')]
    public array $allowedOrigins;

    /**
     * Combined shared and project origins.
     *
     * @var list<string> $effectiveAllowedOrigins
     */
    #[Required('effective_allowed_origins', list: 'string')]
    public array $effectiveAllowedOrigins;

    /**
     * Effective retention in seconds after resolving the installation default. 0 disables expiration.
     */
    #[Required('effective_retention_seconds')]
    public int $effectiveRetentionSeconds;

    #[Required]
    public string $name;

    #[Required('project_id')]
    public string $projectID;

    /**
     * Retention by server receipt time, in seconds. 0 disables expiration; null inherits the installation default.
     */
    #[Required('retention_seconds')]
    public ?int $retentionSeconds;

    #[Optional]
    public ?string $warning;

    /**
     * `new Project()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Project::with(
     *   allowedOrigins: ...,
     *   effectiveAllowedOrigins: ...,
     *   effectiveRetentionSeconds: ...,
     *   name: ...,
     *   projectID: ...,
     *   retentionSeconds: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Project)
     *   ->withAllowedOrigins(...)
     *   ->withEffectiveAllowedOrigins(...)
     *   ->withEffectiveRetentionSeconds(...)
     *   ->withName(...)
     *   ->withProjectID(...)
     *   ->withRetentionSeconds(...)
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
     * @param list<string> $allowedOrigins
     * @param list<string> $effectiveAllowedOrigins
     */
    public static function with(
        array $allowedOrigins,
        array $effectiveAllowedOrigins,
        int $effectiveRetentionSeconds,
        string $name,
        string $projectID,
        ?int $retentionSeconds,
        ?string $warning = null,
    ): self {
        $self = new self;

        $self['allowedOrigins'] = $allowedOrigins;
        $self['effectiveAllowedOrigins'] = $effectiveAllowedOrigins;
        $self['effectiveRetentionSeconds'] = $effectiveRetentionSeconds;
        $self['name'] = $name;
        $self['projectID'] = $projectID;
        $self['retentionSeconds'] = $retentionSeconds;

        null !== $warning && $self['warning'] = $warning;

        return $self;
    }

    /**
     * @param list<string> $allowedOrigins
     */
    public function withAllowedOrigins(array $allowedOrigins): self
    {
        $self = clone $this;
        $self['allowedOrigins'] = $allowedOrigins;

        return $self;
    }

    /**
     * Combined shared and project origins.
     *
     * @param list<string> $effectiveAllowedOrigins
     */
    public function withEffectiveAllowedOrigins(
        array $effectiveAllowedOrigins
    ): self {
        $self = clone $this;
        $self['effectiveAllowedOrigins'] = $effectiveAllowedOrigins;

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

    public function withWarning(string $warning): self
    {
        $self = clone $this;
        $self['warning'] = $warning;

        return $self;
    }
}
