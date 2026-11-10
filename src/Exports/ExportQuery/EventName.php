<?php

declare(strict_types=1);

namespace ChunkifyAnalytics\Exports\ExportQuery;

enum EventName: string
{
    case CHUNKIFY_VIDEO_VIEW_STARTED = 'chunkify.video.view_started';

    case CHUNKIFY_VIDEO_VIEW_SNAPSHOT = 'chunkify.video.view_snapshot';

    case CHUNKIFY_VIDEO_PLAYBACK_ERROR = 'chunkify.video.playback_error';

    case CHUNKIFY_VIDEO_VIEW_ENDED = 'chunkify.video.view_ended';

    case CHUNKIFY_VIDEO_PLAYBACK_STATE_CHANGED = 'chunkify.video.playback_state_changed';

    case CHUNKIFY_VIDEO_RENDITION_CHANGED = 'chunkify.video.rendition_changed';

    case CHUNKIFY_VIDEO_SEEK_COMPLETED = 'chunkify.video.seek_completed';

    case CHUNKIFY_VIDEO_SUBTITLE_CHANGED = 'chunkify.video.subtitle_changed';

    case CHUNKIFY_VIDEO_PLAYBACK_RATE_CHANGED = 'chunkify.video.playback_rate_changed';
}
