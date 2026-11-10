<?php

declare(strict_types=1);

namespace ChunkifyAnalytics\Exports\ExportListColumnsParams;

/**
 * Report whose CSV columns to list.
 */
enum Resource: string
{
    case SUMMARY = 'summary';

    case QUALITY = 'quality';

    case ENGAGEMENT = 'engagement';

    case TIMESERIES = 'timeseries';

    case VIDEOS = 'videos';

    case EVENTS = 'events';

    case VIEWS = 'views';

    case ERRORS = 'errors';

    case DIMENSIONS = 'dimensions';

    case RENDITIONS = 'renditions';

    case SUBTITLES = 'subtitles';

    case PLAYBACK_RATES = 'playback_rates';

    case RETENTION = 'retention';
}
