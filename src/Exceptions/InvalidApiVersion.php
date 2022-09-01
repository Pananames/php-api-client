<?php

namespace Pananames\Api\Exceptions;

use Exception;

class InvalidApiVersion extends Exception
{
    /**
     * @var string
     */
    protected $message = 'Client for the specified API version does not exist';
}
