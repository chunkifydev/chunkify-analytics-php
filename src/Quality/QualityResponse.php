<?php

declare(strict_types=1);

namespace ChunkifyAnalytics\Quality;

use ChunkifyAnalytics\Core\Concerns\SdkUnion;
use ChunkifyAnalytics\Core\Conversion\Contracts\Converter;
use ChunkifyAnalytics\Core\Conversion\Contracts\ConverterSource;

/**
 * Playback quality for the same start cohort as summary. All rates are fractions. Counts expose measurement coverage.
 *
 * @phpstan-import-type QualityShape from \ChunkifyAnalytics\Quality\Quality
 * @phpstan-import-type QualityBreakdownPageShape from \ChunkifyAnalytics\Quality\QualityBreakdownPage
 *
 * @phpstan-type QualityResponseVariants = Quality|QualityBreakdownPage
 * @phpstan-type QualityResponseShape = QualityResponseVariants|QualityShape|QualityBreakdownPageShape
 */
final class QualityResponse implements ConverterSource
{
    use SdkUnion;

    /**
     * @return list<string|Converter|ConverterSource>|array<string,string|Converter|ConverterSource>
     */
    public static function variants(): array
    {
        return [Quality::class, QualityBreakdownPage::class];
    }
}
