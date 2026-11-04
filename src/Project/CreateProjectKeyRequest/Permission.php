<?php

declare(strict_types=1);

namespace ChunkifyAnalytics\Project\CreateProjectKeyRequest;

enum Permission: string
{
    case PUBLIC = 'public';

    case SECRET = 'secret';
}
