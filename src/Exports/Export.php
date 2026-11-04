<?php

declare(strict_types=1);

namespace ChunkifyAnalytics\Exports;

use ChunkifyAnalytics\Core\Attributes\Required;
use ChunkifyAnalytics\Core\Concerns\SdkModel;
use ChunkifyAnalytics\Core\Contracts\BaseModel;

/**
 * @phpstan-type ExportShape = array{
 *   contentType: 'text/csv',
 *   downloadURL: string,
 *   expiresAt: \DateTimeInterface,
 *   filename: string,
 * }
 */
final class Export implements BaseModel
{
    /** @use SdkModel<ExportShape> */
    use SdkModel;

    /** @var 'text/csv' $contentType */
    #[Required('content_type')]
    public string $contentType = 'text/csv';

    #[Required('download_url')]
    public string $downloadURL;

    #[Required('expires_at')]
    public \DateTimeInterface $expiresAt;

    #[Required]
    public string $filename;

    /**
     * `new Export()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Export::with(downloadURL: ..., expiresAt: ..., filename: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Export)->withDownloadURL(...)->withExpiresAt(...)->withFilename(...)
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
        string $downloadURL,
        \DateTimeInterface $expiresAt,
        string $filename
    ): self {
        $self = new self;

        $self['downloadURL'] = $downloadURL;
        $self['expiresAt'] = $expiresAt;
        $self['filename'] = $filename;

        return $self;
    }

    /**
     * @param 'text/csv' $contentType
     */
    public function withContentType(string $contentType): self
    {
        $self = clone $this;
        $self['contentType'] = $contentType;

        return $self;
    }

    public function withDownloadURL(string $downloadURL): self
    {
        $self = clone $this;
        $self['downloadURL'] = $downloadURL;

        return $self;
    }

    public function withExpiresAt(\DateTimeInterface $expiresAt): self
    {
        $self = clone $this;
        $self['expiresAt'] = $expiresAt;

        return $self;
    }

    public function withFilename(string $filename): self
    {
        $self = clone $this;
        $self['filename'] = $filename;

        return $self;
    }
}
