<?php

declare(strict_types=1);

namespace ChunkifyAnalytics\Events\SeekCompleted;

enum SeekOutcome: string
{
    case RESUMED = 'resumed';

    case PAUSED = 'paused';

    case INTERRUPTED = 'interrupted';
}
