<?php

declare(strict_types=1);

namespace ChunkifyAnalytics\Events\PlaybackError;

/**
 * Tab visibility when the event was recorded. Hidden does not imply paused playback or identify the cause of a pause. Missing on older events; null when unavailable.
 */
enum VisibilityState: string
{
    case VISIBLE = 'visible';

    case HIDDEN = 'hidden';
}
