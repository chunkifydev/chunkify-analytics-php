<?php

namespace ChunkifyAnalytics\Core\Exceptions;

class ConflictException extends APIStatusException
{
    /** @var string */
    protected const DESC = 'ChunkifyAnalytics Conflict Exception';
}
