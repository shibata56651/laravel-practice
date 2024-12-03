<?php

namespace App\Exceptions;

use App\Consts\Messages\ExceptionMessages;
use Exception;

class DatabaseException extends CustomException
{
    public function __construct(string $message = ExceptionMessages::DATABASE_FAILED, $code = 500, ?Exception $previous = null, string $log_level = CustomException::LOG_LEVEL_ERROR)
    {
        parent::__construct($message, $code, $previous, $log_level);
    }
}
