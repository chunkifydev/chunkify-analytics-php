<?php

declare(strict_types=1);

namespace ChunkifyAnalytics\Health;

use ChunkifyAnalytics\Core\Attributes\Required;
use ChunkifyAnalytics\Core\Concerns\SdkModel;
use ChunkifyAnalytics\Core\Contracts\BaseModel;

/**
 * @phpstan-type HealthShape = array{status: 'ok'}
 */
final class Health implements BaseModel
{
    /** @use SdkModel<HealthShape> */
    use SdkModel;

    /** @var 'ok' $status */
    #[Required]
    public string $status = 'ok';

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(): self
    {
        return new self;
    }

    /**
     * @param 'ok' $status
     */
    public function withStatus(string $status): self
    {
        $self = clone $this;
        $self['status'] = $status;

        return $self;
    }
}
