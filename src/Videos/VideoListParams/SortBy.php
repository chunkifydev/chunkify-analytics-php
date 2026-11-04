<?php

declare(strict_types=1);

namespace ChunkifyAnalytics\Videos\VideoListParams;

/**
 * Rank all matching videos before pagination. Missing scores come last in both directions. Metric ties use video_id ascending. Keep sort_by, order and filters unchanged with a cursor.
 */
enum SortBy: string
{
    case VIDEO_ID = 'video_id';

    case VIEWS = 'views';

    case UNIQUE_VIEWERS = 'unique_viewers';

    case TOTAL_PLAYING_TIME_MS = 'total_playing_time_ms';

    case PLAYBACK_SCORE = 'playback_score';
}
