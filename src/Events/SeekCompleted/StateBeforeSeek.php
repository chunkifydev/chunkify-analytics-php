<?php

declare(strict_types=1);

namespace ChunkifyAnalytics\Events\SeekCompleted;

enum StateBeforeSeek: string
{
    case STARTUP = 'startup';

    case RESUMING = 'resuming';

    case PLAYING = 'playing';

    case PAUSED = 'paused';

    case BUFFERING = 'buffering';

    case SEEKING = 'seeking';

    case ERROR = 'error';

    case ENDED = 'ended';

    case STOPPED = 'stopped';
}
