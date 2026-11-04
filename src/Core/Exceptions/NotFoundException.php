<?php

namespace ChunkifyAnalytics\Core\Exceptions;

class NotFoundException extends APIStatusException
{
    /** @var string */
    protected const DESC = 'ChunkifyAnalytics Not Found Exception';
}
