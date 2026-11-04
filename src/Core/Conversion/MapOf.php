<?php

declare(strict_types=1);

namespace ChunkifyAnalytics\Core\Conversion;

use ChunkifyAnalytics\Core\Conversion\Concerns\ArrayOf;
use ChunkifyAnalytics\Core\Conversion\Contracts\Converter;

/**
 * @internal
 */
final class MapOf implements Converter
{
    use ArrayOf;
}
