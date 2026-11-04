<?php

declare(strict_types=1);

namespace ChunkifyAnalytics\Summary\MetricsBreakdownPage;

enum GroupBy: string
{
    case BROWSER_NAME = 'browser_name';

    case OS_NAME = 'os_name';

    case DEVICE_TYPE = 'device_type';

    case CONTINENT = 'continent';

    case COUNTRY = 'country';

    case CITY = 'city';

    case PAGE_ORIGIN = 'page_origin';

    case PAGE_PATH = 'page_path';
}
