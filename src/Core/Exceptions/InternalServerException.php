<?php

namespace ChunkifyAnalytics\Core\Exceptions;

class InternalServerException extends APIStatusException
{
    /** @var string */
    protected const DESC = 'ChunkifyAnalytics Internal Server Exception';
}
