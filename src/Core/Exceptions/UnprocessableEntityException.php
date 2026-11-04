<?php

namespace ChunkifyAnalytics\Core\Exceptions;

class UnprocessableEntityException extends APIStatusException
{
    /** @var string */
    protected const DESC = 'ChunkifyAnalytics Unprocessable Entity Exception';
}
