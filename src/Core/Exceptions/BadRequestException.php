<?php

namespace ChunkifyAnalytics\Core\Exceptions;

class BadRequestException extends APIStatusException
{
    /** @var string */
    protected const DESC = 'ChunkifyAnalytics Bad Request Exception';
}
