<?php

namespace Pananames\Api\Exceptions;

use Exception;

class InvalidApiResponse extends Exception
{
    protected $message = 'Response does not contain valid JSON';
}
