<?php

namespace Pananames\Api\Exceptions;

use Exception;

class InvalidHttpClient extends Exception
{
    /**
     * @var string
     */
    protected $message = 'Class for the specified HTTP Client does not exist';
}