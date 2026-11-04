<?php

declare(strict_types=1);

namespace ChunkifyAnalytics\Admin;

use ChunkifyAnalytics\Core\Attributes\Optional;
use ChunkifyAnalytics\Core\Attributes\Required;
use ChunkifyAnalytics\Core\Concerns\SdkModel;
use ChunkifyAnalytics\Core\Concerns\SdkParams;
use ChunkifyAnalytics\Core\Contracts\BaseModel;
use ChunkifyAnalytics\Core\Omit;

/**
 * Generate a project ID and initial keys, optionally setting retention. Requires the installation admin key. The project and its retention are active before success is returned.
 *
 * @see ChunkifyAnalytics\Services\AdminService::createProject()
 *
 * @phpstan-type AdminCreateProjectParamsShape = array{
 *   name: string, allowedOrigins?: list<string>|null, retentionSeconds?: int|null
 * }
 */
final class AdminCreateProjectParams implements BaseModel
{
    /** @use SdkModel<AdminCreateProjectParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Project display name.
     */
    #[Required]
    public string $name;

    /**
     * Additional project origins. Shared TOML origins are always included.
     *
     * @var list<string>|null $allowedOrigins
     */
    #[Optional('allowed_origins', list: 'string')]
    public ?array $allowedOrigins;

    /**
     * Retention by server receipt time, in seconds. 0 disables expiration; null inherits the installation default. Omission also inherits the default.
     */
    #[Optional('retention_seconds', nullable: true)]
    public ?int $retentionSeconds;

    /**
     * `new AdminCreateProjectParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * AdminCreateProjectParams::with(name: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new AdminCreateProjectParams)->withName(...)
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
     * @param list<string>|null $allowedOrigins
     */
    public static function with(
        string $name,
        ?array $allowedOrigins = null,
        int|Omit|null $retentionSeconds = Omit::Value,
    ): self {
        $self = new self;

        $self['name'] = $name;

        null !== $allowedOrigins && $self['allowedOrigins'] = $allowedOrigins;
        Omit::Value !== $retentionSeconds && $self['retentionSeconds'] = $retentionSeconds;

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

    /**
     * Retention by server receipt time, in seconds. 0 disables expiration; null inherits the installation default. Omission also inherits the default.
     */
    public function withRetentionSeconds(?int $retentionSeconds): self
    {
        $self = clone $this;
        $self['retentionSeconds'] = $retentionSeconds;

        return $self;
    }
}
