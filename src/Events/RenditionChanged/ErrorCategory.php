<?php

declare(strict_types=1);

namespace ChunkifyAnalytics\Events\RenditionChanged;

enum ErrorCategory: string
{
    case ABORTED = 'aborted';

    case NETWORK = 'network';

    case DECODE = 'decode';

    case UNSUPPORTED = 'unsupported';

    case UNKNOWN = 'unknown';
}
