<?php

namespace Pananames\Api\Exceptions;

use Exception;

class InvalidApiVersion extends Exception
{
    protected $message = 'Client for the specified API version does not exist';
}
