<?php

declare(strict_types=1);

namespace ChunkifyAnalytics\Exports\ExportListColumnsParams;

/**
 * Metric set for every time bucket. Uses the same calculations and sample counts as the corresponding totals route.
 */
enum Kind: string
{
    case SUMMARY = 'summary';

    case QUALITY = 'quality';

    case ENGAGEMENT = 'engagement';
}
