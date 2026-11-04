<?php

declare(strict_types=1);

namespace ChunkifyAnalytics\Videos;

use ChunkifyAnalytics\Core\Attributes\Required;
use ChunkifyAnalytics\Core\Concerns\SdkModel;
use ChunkifyAnalytics\Core\Contracts\BaseModel;

/**
 * @phpstan-import-type VideoMetricsShape from \ChunkifyAnalytics\Videos\VideoMetrics
 *
 * @phpstan-type VideoPageShape = array{
 *   nextCursor: string|null, videos: list<VideoMetrics|VideoMetricsShape>
 * }
 */
final class VideoPage implements BaseModel
{
    /** @use SdkModel<VideoPageShape> */
    use SdkModel;

    #[Required('next_cursor')]
    public ?string $nextCursor;

    /** @var list<VideoMetrics> $videos */
    #[Required(list: VideoMetrics::class)]
    public array $videos;

    /**
     * `new VideoPage()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * VideoPage::with(nextCursor: ..., videos: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new VideoPage)->withNextCursor(...)->withVideos(...)
     * ```
     */
    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param list<VideoMetrics|VideoMetricsShape> $videos
     */
    public static function with(?string $nextCursor, array $videos): self
    {
        $self = new self;

        $self['nextCursor'] = $nextCursor;
        $self['videos'] = $videos;

        return $self;
    }

    public function withNextCursor(?string $nextCursor): self
    {
        $self = clone $this;
        $self['nextCursor'] = $nextCursor;

        return $self;
    }

    /**
     * @param list<VideoMetrics|VideoMetricsShape> $videos
     */
    public function withVideos(array $videos): self
    {
        $self = clone $this;
        $self['videos'] = $videos;

        return $self;
    }
}
