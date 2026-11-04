<?php

declare(strict_types=1);

namespace ChunkifyAnalytics\Exports\ExportQuery;

enum Interval: string
{
    case HOUR = 'hour';

    case DAY = 'day';
}
