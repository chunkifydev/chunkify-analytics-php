<?php

declare(strict_types=1);

namespace ChunkifyAnalytics\Project\ProjectKey;

enum Permission: string
{
    case PUBLIC = 'public';

    case SECRET = 'secret';
}
