<?php

declare(strict_types=1);

namespace ChunkifyAnalytics\StoredOtlpContext;

use ChunkifyAnalytics\Core\Attributes\Optional;
use ChunkifyAnalytics\Core\Concerns\SdkModel;
use ChunkifyAnalytics\Core\Contracts\BaseModel;
use ChunkifyAnalytics\Core\Omit;
use ChunkifyAnalytics\OtlpScope;

/**
 * Original scope group excluding logRecords.
 *
 * @phpstan-import-type OtlpScopeShape from \ChunkifyAnalytics\OtlpScope
 *
 * @phpstan-type ScopeLogsShape = array{
 *   schemaURL?: string|null, scope?: null|OtlpScope|OtlpScopeShape
 * }
 */
final class ScopeLogs implements BaseModel
{
    /** @use SdkModel<ScopeLogsShape> */
    use SdkModel;

    #[Optional('schemaUrl', nullable: true)]
    public ?string $schemaURL;

    #[Optional(nullable: true)]
    public ?OtlpScope $scope;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param Omit|OtlpScope|OtlpScopeShape|null $scope
     */
    public static function with(
        string|Omit|null $schemaURL = Omit::Value,
        Omit|OtlpScope|array|null $scope = Omit::Value,
    ): self {
        $self = new self;

        Omit::Value !== $schemaURL && $self['schemaURL'] = $schemaURL;
        Omit::Value !== $scope && $self['scope'] = $scope;

        return $self;
    }

    public function withSchemaURL(?string $schemaURL): self
    {
        $self = clone $this;
        $self['schemaURL'] = $schemaURL;

        return $self;
    }

    /**
     * @param OtlpScope|OtlpScopeShape|null $scope
     */
    public function withScope(OtlpScope|array|null $scope): self
    {
        $self = clone $this;
        $self['scope'] = $scope;

        return $self;
    }
}
