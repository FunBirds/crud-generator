<?php

namespace Foxdevuz\CrudGenerator\Exceptions;

use Exception;

class FileAlreadyExistsException extends Exception
{
    public function __construct($message = "File already exists", $code = 0, Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}