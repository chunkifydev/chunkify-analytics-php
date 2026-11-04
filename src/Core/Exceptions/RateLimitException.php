<?php

namespace ChunkifyAnalytics\Core\Exceptions;

class RateLimitException extends APIStatusException
{
    /** @var string */
    protected const DESC = 'ChunkifyAnalytics Rate Limit Exception';
}
