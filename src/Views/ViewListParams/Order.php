<?php

declare(strict_types=1);

namespace ChunkifyAnalytics\Views\ViewListParams;

/**
 * Sort by started_at and then view_id in this direction. Defaults to newest first. Keep the same order with each cursor.
 */
enum Order: string
{
    case ASC = 'asc';

    case DESC = 'desc';
}
