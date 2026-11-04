<?php

declare(strict_types=1);

namespace ChunkifyAnalytics\Core;

/**
 * Distinguishes an omitted argument from an explicit null value.
 */
enum Omit
{
    case Value;
}
