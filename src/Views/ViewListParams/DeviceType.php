<?php

declare(strict_types=1);

namespace ChunkifyAnalytics\Views\ViewListParams;

/**
 * Exact device class. unknown matches an explicit unknown value.
 */
enum DeviceType: string
{
    case DESKTOP = 'desktop';

    case MOBILE = 'mobile';

    case TABLET = 'tablet';

    case UNKNOWN = 'unknown';
}
