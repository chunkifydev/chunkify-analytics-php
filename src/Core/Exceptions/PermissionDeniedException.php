<?php

namespace ChunkifyAnalytics\Core\Exceptions;

class PermissionDeniedException extends APIStatusException
{
    /** @var string */
    protected const DESC = 'ChunkifyAnalytics Permission Denied Exception';
}
