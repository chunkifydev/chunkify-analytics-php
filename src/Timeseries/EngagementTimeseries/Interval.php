<?php

declare(strict_types=1);

namespace ChunkifyAnalytics\Timeseries\EngagementTimeseries;

enum Interval: string
{
    case HOUR = 'hour';

    case DAY = 'day';
}
