<?php

declare(strict_types=1);

namespace ChunkifyAnalytics\Timeseries\QualityTimeseries;

enum Interval: string
{
    case HOUR = 'hour';

    case DAY = 'day';
}
