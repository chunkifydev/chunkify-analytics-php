<?php

declare(strict_types=1);

namespace ChunkifyAnalytics\Core\Conversion\Contracts;

use ChunkifyAnalytics\Core\Conversion\CoerceState;
use ChunkifyAnalytics\Core\Conversion\DumpState;

/**
 * @internal
 */
interface Converter
{
    /**
     * @internal
     */
    public function coerce(mixed $value, CoerceState $state): mixed;

    /**
     * @internal
     */
    public function dump(mixed $value, DumpState $state): mixed;
}
