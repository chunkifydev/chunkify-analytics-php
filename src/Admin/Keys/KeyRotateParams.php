<?php

declare(strict_types=1);

namespace ChunkifyAnalytics\Admin\Keys;

use ChunkifyAnalytics\Core\Attributes\Required;
use ChunkifyAnalytics\Core\Concerns\SdkModel;
use ChunkifyAnalytics\Core\Concerns\SdkParams;
use ChunkifyAnalytics\Core\Contracts\BaseModel;

/**
 * Replace one existing public or secret key using CHUNKIFY_ADMIN_KEY, even when the project secret was lost. The old value stops working immediately. Key ID, type and read-only access are preserved; other keys are unchanged. Save the returned replacement. Intended for a trusted backend that verifies project ownership.
 *
 * @see ChunkifyAnalytics\Services\Admin\KeysService::rotate()
 *
 * @phpstan-type KeyRotateParamsShape = array{projectID: string}
 */
final class KeyRotateParams implements BaseModel
{
    /** @use SdkModel<KeyRotateParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Required]
    public string $projectID;

    /**
     * `new KeyRotateParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * KeyRotateParams::with(projectID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new KeyRotateParams)->withProjectID(...)
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
    public static function with(string $projectID): self
    {
        $self = new self;

        $self['projectID'] = $projectID;

        return $self;
    }

    public function withProjectID(string $projectID): self
    {
        $self = clone $this;
        $self['projectID'] = $projectID;

        return $self;
    }
}
