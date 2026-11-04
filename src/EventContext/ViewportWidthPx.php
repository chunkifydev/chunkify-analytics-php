<?php

declare(strict_types=1);

namespace ChunkifyAnalytics\EventContext;

use ChunkifyAnalytics\Core\Concerns\SdkUnion;
use ChunkifyAnalytics\Core\Conversion\Contracts\Converter;
use ChunkifyAnalytics\Core\Conversion\Contracts\ConverterSource;

/**
 * Copied from browser_context.viewport_width_px when primitive. See BrowserContext for the SDK type; the collector currently accepts any primitive here.
 *
 * @phpstan-type ViewportWidthPxVariants = string|float|bool
 * @phpstan-type ViewportWidthPxShape = ViewportWidthPxVariants
 */
final class ViewportWidthPx implements ConverterSource
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
