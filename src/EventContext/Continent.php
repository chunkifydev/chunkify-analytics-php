<?php

declare(strict_types=1);

namespace ChunkifyAnalytics\EventContext;

/**
 * Continent code from the local City MMDB lookup: Africa, Antarctica, Asia, Europe, North America, Oceania or South America. Null when unknown.
 */
enum Continent: string
{
    case AF = 'AF';

    case AN = 'AN';

    case AS = 'AS';

    case EU = 'EU';

    case NA = 'NA';

    case OC = 'OC';

    case SA = 'SA';
}
