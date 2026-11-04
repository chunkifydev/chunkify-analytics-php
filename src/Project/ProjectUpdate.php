<?php

declare(strict_types=1);

namespace ChunkifyAnalytics\Project;

use ChunkifyAnalytics\Core\Attributes\Optional;
use ChunkifyAnalytics\Core\Concerns\SdkModel;
use ChunkifyAnalytics\Core\Contracts\BaseModel;
use ChunkifyAnalytics\Core\Omit;

/**
 * @phpstan-type ProjectUpdateShape = array{
 *   allowedOrigins?: list<string>|null,
 *   name?: string|null,
 *   retentionSeconds?: int|null,
 * }
 */
final class ProjectUpdate implements BaseModel
{
    /** @use SdkModel<ProjectUpdateShape> */
    use SdkModel;

    /**
     * Additional project origins. Shared TOML origins are always included.
     *
     * @var list<string>|null $allowedOrigins
     */
    #[Optional('allowed_origins', list: 'string')]
    public ?array $allowedOrigins;

    #[Optional]
    public ?string $name;

    /**
     * Retention by server receipt time, in seconds. 0 disables expiration; null inherits the installation default. Omission leaves the current setting unchanged. Applies to existing and new events; removed data cannot be recovered.
     */
    #[Optional('retention_seconds', nullable: true)]
    public ?int $retentionSeconds;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param list<string>|null $allowedOrigins
     */
    public static function with(
        ?array $allowedOrigins = null,
        ?string $name = null,
        int|Omit|null $retentionSeconds = Omit::Value,
    ): self {
        $self = new self;

        null !== $allowedOrigins && $self['allowedOrigins'] = $allowedOrigins;
        null !== $name && $self['name'] = $name;
        Omit::Value !== $retentionSeconds && $self['retentionSeconds'] = $retentionSeconds;

        return $self;
    }

    /**
     * Additional project origins. Shared TOML origins are always included.
     *
     * @param list<string> $allowedOrigins
     */
    public function withAllowedOrigins(array $allowedOrigins): self
    {
        $self = clone $this;
        $self['allowedOrigins'] = $allowedOrigins;

        return $self;
    }

    public function withName(string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }

    /**
     * Retention by server receipt time, in seconds. 0 disables expiration; null inherits the installation default. Omission leaves the current setting unchanged. Applies to existing and new events; removed data cannot be recovered.
     */
    public function withRetentionSeconds(?int $retentionSeconds): self
    {
        $self = clone $this;
        $self['retentionSeconds'] = $retentionSeconds;

        return $self;
    }
}
