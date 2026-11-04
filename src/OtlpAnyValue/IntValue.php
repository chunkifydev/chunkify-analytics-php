<?php

declare(strict_types=1);

namespace ChunkifyAnalytics\OtlpAnyValue;

use ChunkifyAnalytics\Core\Concerns\SdkUnion;
use ChunkifyAnalytics\Core\Conversion\Contracts\Converter;
use ChunkifyAnalytics\Core\Conversion\Contracts\ConverterSource;

/**
 * Signed int64. Strings avoid JavaScript precision loss.
 *
 * @phpstan-type IntValueVariants = string|int
 * @phpstan-type IntValueShape = IntValueVariants
 */
final class IntValue implements ConverterSource
{
    use SdkUnion;

    /**
     * @return list<string|Converter|ConverterSource>|array<string,string|Converter|ConverterSource>
     */
    public static function variants(): array
    {
        return ['string', 'int'];
    }
}
