<?php

declare(strict_types=1);

namespace ChunkifyAnalytics\Exports\ExportQuery;

enum Dimension: string
{
    case BROWSER_NAME = 'browser_name';

    case OS_NAME = 'os_name';

    case DEVICE_TYPE = 'device_type';

    case VIDEO_ID = 'video_id';

    case VIEWER_ID = 'viewer_id';

    case CONTINENT = 'continent';

    case COUNTRY = 'country';

    case CITY = 'city';

    case PAGE_ORIGIN = 'page_origin';

    case PAGE_PATH = 'page_path';
}
