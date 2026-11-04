<?php

declare(strict_types=1);

namespace ChunkifyAnalytics;

use ChunkifyAnalytics\Core\Attributes\Required;
use ChunkifyAnalytics\Core\Concerns\SdkModel;
use ChunkifyAnalytics\Core\Contracts\BaseModel;
use ChunkifyAnalytics\StoredOtlpContext\ResourceLogs;
use ChunkifyAnalytics\StoredOtlpContext\ScopeLogs;

/**
 * Legacy context present for an event received through OTLP by an earlier collector version. Existing context remains readable; new ingestion accepts native JSON events only.
 *
 * @phpstan-import-type OtlpLogRecordShape from \ChunkifyAnalytics\OtlpLogRecord
 * @phpstan-import-type ResourceLogsShape from \ChunkifyAnalytics\StoredOtlpContext\ResourceLogs
 * @phpstan-import-type ScopeLogsShape from \ChunkifyAnalytics\StoredOtlpContext\ScopeLogs
 *
 * @phpstan-type StoredOtlpContextShape = array{
 *   logRecord: OtlpLogRecord|OtlpLogRecordShape,
 *   resourceLogs: ResourceLogs|ResourceLogsShape,
 *   scopeLogs: ScopeLogs|ScopeLogsShape,
 * }
 */
final class StoredOtlpContext implements BaseModel
{
    /** @use SdkModel<StoredOtlpContextShape> */
    use SdkModel;

    /**
     * A playback event in log attributes. Duplicate attributes and invalid event fields reject the request.
     */
    #[Required('log_record')]
    public OtlpLogRecord $logRecord;

    /**
     * Original resource group excluding scopeLogs.
     */
    #[Required('resource_logs')]
    public ResourceLogs $resourceLogs;

    /**
     * Original scope group excluding logRecords.
     */
    #[Required('scope_logs')]
    public ScopeLogs $scopeLogs;

    /**
     * `new StoredOtlpContext()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * StoredOtlpContext::with(logRecord: ..., resourceLogs: ..., scopeLogs: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new StoredOtlpContext)
     *   ->withLogRecord(...)
     *   ->withResourceLogs(...)
     *   ->withScopeLogs(...)
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
     * @param OtlpLogRecord|OtlpLogRecordShape $logRecord
     * @param ResourceLogs|ResourceLogsShape $resourceLogs
     * @param ScopeLogs|ScopeLogsShape $scopeLogs
     */
    public static function with(
        OtlpLogRecord|array $logRecord,
        ResourceLogs|array $resourceLogs,
        ScopeLogs|array $scopeLogs,
    ): self {
        $self = new self;

        $self['logRecord'] = $logRecord;
        $self['resourceLogs'] = $resourceLogs;
        $self['scopeLogs'] = $scopeLogs;

        return $self;
    }

    /**
     * A playback event in log attributes. Duplicate attributes and invalid event fields reject the request.
     *
     * @param OtlpLogRecord|OtlpLogRecordShape $logRecord
     */
    public function withLogRecord(OtlpLogRecord|array $logRecord): self
    {
        $self = clone $this;
        $self['logRecord'] = $logRecord;

        return $self;
    }

    /**
     * Original resource group excluding scopeLogs.
     *
     * @param ResourceLogs|ResourceLogsShape $resourceLogs
     */
    public function withResourceLogs(ResourceLogs|array $resourceLogs): self
    {
        $self = clone $this;
        $self['resourceLogs'] = $resourceLogs;

        return $self;
    }

    /**
     * Original scope group excluding logRecords.
     *
     * @param ScopeLogs|ScopeLogsShape $scopeLogs
     */
    public function withScopeLogs(ScopeLogs|array $scopeLogs): self
    {
        $self = clone $this;
        $self['scopeLogs'] = $scopeLogs;

        return $self;
    }
}
