<?php

declare(strict_types=1);

namespace ChunkifyAnalytics\Exports\ExportQuery;

enum Kind: string
{
    case SUMMARY = 'summary';

    case QUALITY = 'quality';

    case ENGAGEMENT = 'engagement';
}
