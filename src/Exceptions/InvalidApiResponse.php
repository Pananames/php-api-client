<?php

namespace Pananames\Api\Exceptions;

use Exception;

class InvalidApiResponse extends Exception
{
    /**
     * @var string
     */
    protected $message = 'Response does not contain valid JSON';
}
