<?php

declare(strict_types=1);

namespace ChunkifyAnalytics\Events\PlaybackStateChanged;

enum Reason: string
{
    case ENDED = 'ended';

    case DESTROYED = 'destroyed';

    case SOURCE_CHANGED = 'source_changed';

    case PAGE_EXIT = 'page_exit';
}
