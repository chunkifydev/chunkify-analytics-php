<?php

declare(strict_types=1);

namespace ChunkifyAnalytics\Events;

use ChunkifyAnalytics\Core\Concerns\SdkUnion;
use ChunkifyAnalytics\Core\Conversion\Contracts\Converter;
use ChunkifyAnalytics\Core\Conversion\Contracts\ConverterSource;

/**
 * A schema version 1 playback event. Extra properties are preserved.
 *
 * @phpstan-import-type ViewStartedShape from \ChunkifyAnalytics\Events\ViewStarted
 * @phpstan-import-type ViewSnapshotShape from \ChunkifyAnalytics\Events\ViewSnapshot
 * @phpstan-import-type PlaybackErrorShape from \ChunkifyAnalytics\Events\PlaybackError
 * @phpstan-import-type ViewEndedShape from \ChunkifyAnalytics\Events\ViewEnded
 * @phpstan-import-type PlaybackStateChangedShape from \ChunkifyAnalytics\Events\PlaybackStateChanged
 * @phpstan-import-type RenditionChangedShape from \ChunkifyAnalytics\Events\RenditionChanged
 * @phpstan-import-type SeekCompletedShape from \ChunkifyAnalytics\Events\SeekCompleted
 * @phpstan-import-type SubtitleChangedShape from \ChunkifyAnalytics\Events\SubtitleChanged
 * @phpstan-import-type PlaybackRateChangedShape from \ChunkifyAnalytics\Events\PlaybackRateChanged
 *
 * @phpstan-type AnalyticsEventVariants = ViewStarted|ViewSnapshot|PlaybackError|ViewEnded|PlaybackStateChanged|RenditionChanged|SeekCompleted|SubtitleChanged|PlaybackRateChanged
 * @phpstan-type AnalyticsEventShape = AnalyticsEventVariants|ViewStartedShape|ViewSnapshotShape|PlaybackErrorShape|ViewEndedShape|PlaybackStateChangedShape|RenditionChangedShape|SeekCompletedShape|SubtitleChangedShape|PlaybackRateChangedShape
 */
final class AnalyticsEvent implements ConverterSource
{
    use SdkUnion;

    public static function discriminator(): string
    {
        return 'event_name';
    }

    /**
     * @return list<string|Converter|ConverterSource>|array<string,string|Converter|ConverterSource>
     */
    public static function variants(): array
    {
        return [
            'chunkify.video.view_started' => ViewStarted::class,
            'chunkify.video.view_snapshot' => ViewSnapshot::class,
            'chunkify.video.playback_error' => PlaybackError::class,
            'chunkify.video.view_ended' => ViewEnded::class,
            'chunkify.video.playback_state_changed' => PlaybackStateChanged::class,
            'chunkify.video.rendition_changed' => RenditionChanged::class,
            'chunkify.video.seek_completed' => SeekCompleted::class,
            'chunkify.video.subtitle_changed' => SubtitleChanged::class,
            'chunkify.video.playback_rate_changed' => PlaybackRateChanged::class,
        ];
    }
}
