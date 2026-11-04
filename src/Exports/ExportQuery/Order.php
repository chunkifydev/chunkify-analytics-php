<?php

declare(strict_types=1);

namespace ChunkifyAnalytics\Exports\ExportQuery;

enum Order: string
{
    case ASC = 'asc';

    case DESC = 'desc';
}
