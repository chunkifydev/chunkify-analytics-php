<?php

declare(strict_types=1);

namespace ChunkifyAnalytics\Timeseries\TimeseryRetrieveParams;

/**
 * UTC hour or day. The requested range can contain at most 1000 buckets.
 */
enum Interval: string
{
    case HOUR = 'hour';

    case DAY = 'day';
}
