<?php

declare(strict_types=1);

namespace ChunkifyAnalytics\Videos\VideoListParams;

/**
 * Sort direction. Events and videos default to asc; views default to desc. Events sort by ingestion sequence. Videos and views sort by sort_by with missing values last. View ties use view_id in the requested direction; video metric ties use video_id ascending.
 */
enum Order: string
{
    case ASC = 'asc';

    case DESC = 'desc';
}
