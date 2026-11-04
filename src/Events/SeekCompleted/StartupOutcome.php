<?php

declare(strict_types=1);

namespace ChunkifyAnalytics\Events\SeekCompleted;

enum StartupOutcome: string
{
    case STARTED = 'started';

    case FAILED_BEFORE_START = 'failed_before_start';

    case ENDED_BEFORE_START = 'ended_before_start';
}
