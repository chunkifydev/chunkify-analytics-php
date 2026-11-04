<?php

declare(strict_types=1);

namespace ChunkifyAnalytics\Views\ViewListParams;

/**
 * Sort all matching sessions before pagination. Missing values come last in both directions. Ties use view_id in the requested direction. Keep sort_by, order and filters unchanged with a cursor.
 */
enum SortBy: string
{
    case STARTED_AT = 'started_at';

    case VIDEO_ID = 'video_id';

    case VIEW_ID = 'view_id';

    case DEVICE_TYPE = 'device_type';

    case PLAYING_TIME_MS = 'playing_time_ms';

    case STARTUP_TIME_MS = 'startup_time_ms';

    case REBUFFER_DURATION_MS = 'rebuffer_duration_ms';

    case PLAYBACK_SCORE = 'playback_score';
}
