<?php

declare(strict_types=1);

namespace ChunkifyAnalytics\Engagement;

use ChunkifyAnalytics\Core\Concerns\SdkUnion;
use ChunkifyAnalytics\Core\Conversion\Contracts\Converter;
use ChunkifyAnalytics\Core\Conversion\Contracts\ConverterSource;

/**
 * Observed watch time and end-of-media for the same start cohort as summary. Missing delivery can undercount both.
 *
 * @phpstan-import-type EngagementShape from \ChunkifyAnalytics\Engagement\Engagement
 * @phpstan-import-type EngagementBreakdownPageShape from \ChunkifyAnalytics\Engagement\EngagementBreakdownPage
 *
 * @phpstan-type EngagementResponseVariants = Engagement|EngagementBreakdownPage
 * @phpstan-type EngagementResponseShape = EngagementResponseVariants|EngagementShape|EngagementBreakdownPageShape
 */
final class EngagementResponse implements ConverterSource
{
    use SdkUnion;

    /**
     * @return list<string|Converter|ConverterSource>|array<string,string|Converter|ConverterSource>
     */
    public static function variants(): array
    {
        return [Engagement::class, EngagementBreakdownPage::class];
    }
}
