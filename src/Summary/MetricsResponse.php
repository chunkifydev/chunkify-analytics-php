<?php

declare(strict_types=1);

namespace ChunkifyAnalytics\Summary;

use ChunkifyAnalytics\Core\Concerns\SdkUnion;
use ChunkifyAnalytics\Core\Conversion\Contracts\Converter;
use ChunkifyAnalytics\Core\Conversion\Contracts\ConverterSource;

/**
 * @phpstan-import-type MetricsShape from \ChunkifyAnalytics\Summary\Metrics
 * @phpstan-import-type MetricsBreakdownPageShape from \ChunkifyAnalytics\Summary\MetricsBreakdownPage
 *
 * @phpstan-type MetricsResponseVariants = Metrics|MetricsBreakdownPage
 * @phpstan-type MetricsResponseShape = MetricsResponseVariants|MetricsShape|MetricsBreakdownPageShape
 */
final class MetricsResponse implements ConverterSource
{
    use SdkUnion;

    /**
     * @return list<string|Converter|ConverterSource>|array<string,string|Converter|ConverterSource>
     */
    public static function variants(): array
    {
        return [Metrics::class, MetricsBreakdownPage::class];
    }
}
