<?php

declare(strict_types=1);

namespace ChunkifyAnalytics\EventContext;

use ChunkifyAnalytics\Core\Concerns\SdkUnion;
use ChunkifyAnalytics\Core\Conversion\Contracts\Converter;
use ChunkifyAnalytics\Core\Conversion\Contracts\ConverterSource;

/**
 * Copied from browser_context.os_name when primitive. See BrowserContext for the SDK type; the collector currently accepts any primitive here.
 *
 * @phpstan-type OsNameVariants = string|float|bool
 * @phpstan-type OsNameShape = OsNameVariants
 */
final class OsName implements ConverterSource
{
    use SdkUnion;

    /**
     * @return list<string|Converter|ConverterSource>|array<string,string|Converter|ConverterSource>
     */
    public static function variants(): array
    {
        return ['string', 'float', 'bool'];
    }
}
