<?php

declare(strict_types=1);

namespace ChunkifyAnalytics\Events\SubtitleChanged;

/**
 * How the player receives the media: hls for an HLS stream, file for a single media file such as an MP4 rendition; null when unknown. Optional: older SDKs omit it. Reports read it from each view's first start. Unlike connector_name, it does not depend on the playback engine: Safari's native HLS reports html-media.
 */
enum DeliveryFormat: string
{
    case HLS = 'hls';

    case FILE = 'file';
}
