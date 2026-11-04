<?php

declare(strict_types=1);

namespace ChunkifyAnalytics\Exports\ExportQuery;

/**
 * Videos or views only. Use a sort field supported by the selected resource. Defaults to video_id for videos and started_at for views.
 */
enum SortBy: string
{
    case VIDEO_ID = 'video_id';

    case VIEWS = 'views';

    case UNIQUE_VIEWERS = 'unique_viewers';

    case TOTAL_PLAYING_TIME_MS = 'total_playing_time_ms';

    case PLAYBACK_SCORE = 'playback_score';

    case STARTED_AT = 'started_at';

    case VIEW_ID = 'view_id';

    case DEVICE_TYPE = 'device_type';

    case PLAYING_TIME_MS = 'playing_time_ms';

    case STARTUP_TIME_MS = 'startup_time_ms';

    case REBUFFER_DURATION_MS = 'rebuffer_duration_ms';
}
