<?php

declare(strict_types=1);

namespace ChunkifyAnalytics\Exports\ExportQuery;

enum DeliveryFormat: string
{
    case HLS = 'hls';

    case FILE = 'file';
}
