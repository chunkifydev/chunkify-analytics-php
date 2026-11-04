<?php

declare(strict_types=1);

namespace ChunkifyAnalytics\Events;

use ChunkifyAnalytics\Core\Concerns\SdkUnion;
use ChunkifyAnalytics\Core\Conversion\Contracts\Converter;
use ChunkifyAnalytics\Core\Conversion\Contracts\ConverterSource;

/**
 * @phpstan-import-type NativeCreatedShape from \ChunkifyAnalytics\Events\NativeCreated
 * @phpstan-import-type NativeDuplicateShape from \ChunkifyAnalytics\Events\NativeDuplicate
 *
 * @phpstan-type EventIngestResponseVariants = NativeCreated|NativeDuplicate
 * @phpstan-type EventIngestResponseShape = EventIngestResponseVariants|NativeCreatedShape|NativeDuplicateShape
 */
final class EventIngestResponse implements ConverterSource
{
    use SdkUnion;

    /**
     * @return list<string|Converter|ConverterSource>|array<string,string|Converter|ConverterSource>
     */
    public static function variants(): array
    {
        return [NativeCreated::class, NativeDuplicate::class];
    }
}
