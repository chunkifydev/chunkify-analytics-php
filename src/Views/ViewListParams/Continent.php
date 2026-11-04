<?php

declare(strict_types=1);

namespace ChunkifyAnalytics\Views\ViewListParams;

/**
 * Exact continent code from the local lookup. Missing locations do not match.
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
