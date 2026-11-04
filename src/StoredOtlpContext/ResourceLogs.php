<?php

declare(strict_types=1);

namespace ChunkifyAnalytics\StoredOtlpContext;

use ChunkifyAnalytics\Core\Attributes\Optional;
use ChunkifyAnalytics\Core\Concerns\SdkModel;
use ChunkifyAnalytics\Core\Contracts\BaseModel;
use ChunkifyAnalytics\Core\Omit;
use ChunkifyAnalytics\OtlpResource;

/**
 * Original resource group excluding scopeLogs.
 *
 * @phpstan-import-type OtlpResourceShape from \ChunkifyAnalytics\OtlpResource
 *
 * @phpstan-type ResourceLogsShape = array{
 *   resource?: null|OtlpResource|OtlpResourceShape, schemaURL?: string|null
 * }
 */
final class ResourceLogs implements BaseModel
{
    /** @use SdkModel<ResourceLogsShape> */
    use SdkModel;

    #[Optional(nullable: true)]
    public ?OtlpResource $resource;

    #[Optional('schemaUrl', nullable: true)]
    public ?string $schemaURL;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param Omit|OtlpResource|OtlpResourceShape|null $resource
     */
    public static function with(
        Omit|OtlpResource|array|null $resource = Omit::Value,
        string|Omit|null $schemaURL = Omit::Value,
    ): self {
        $self = new self;

        Omit::Value !== $resource && $self['resource'] = $resource;
        Omit::Value !== $schemaURL && $self['schemaURL'] = $schemaURL;

        return $self;
    }

    /**
     * @param OtlpResource|OtlpResourceShape|null $resource
     */
    public function withResource(OtlpResource|array|null $resource): self
    {
        $self = clone $this;
        $self['resource'] = $resource;

        return $self;
    }

    public function withSchemaURL(?string $schemaURL): self
    {
        $self = clone $this;
        $self['schemaURL'] = $schemaURL;

        return $self;
    }
}
