<?php

declare(strict_types=1);

namespace ChunkifyAnalytics\Core\Conversion;

use ChunkifyAnalytics\Core\Conversion\Concerns\ArrayOf;
use ChunkifyAnalytics\Core\Conversion\Contracts\Converter;

/**
 * @internal
 */
final class ListOf implements Converter
{
    use ArrayOf;

    // @phpstan-ignore-next-line missingType.iterableValue
    private function empty(): array|object
    {
        return [];
    }
}
