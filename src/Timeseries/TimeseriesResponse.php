<?php

declare(strict_types=1);

namespace ChunkifyAnalytics\Timeseries;

use ChunkifyAnalytics\Core\Concerns\SdkUnion;
use ChunkifyAnalytics\Core\Conversion\Contracts\Converter;
use ChunkifyAnalytics\Core\Conversion\Contracts\ConverterSource;

/**
 * @phpstan-import-type TimeseriesShape from \ChunkifyAnalytics\Timeseries\Timeseries
 * @phpstan-import-type QualityTimeseriesShape from \ChunkifyAnalytics\Timeseries\QualityTimeseries
 * @phpstan-import-type EngagementTimeseriesShape from \ChunkifyAnalytics\Timeseries\EngagementTimeseries
 *
 * @phpstan-type TimeseriesResponseVariants = Timeseries|QualityTimeseries|EngagementTimeseries
 * @phpstan-type TimeseriesResponseShape = TimeseriesResponseVariants|TimeseriesShape|QualityTimeseriesShape|EngagementTimeseriesShape
 */
final class TimeseriesResponse implements ConverterSource
{
    use SdkUnion;

    /**
     * @return list<string|Converter|ConverterSource>|array<string,string|Converter|ConverterSource>
     */
    public static function variants(): array
    {
        return [
            Timeseries::class, QualityTimeseries::class, EngagementTimeseries::class,
        ];
    }
}
