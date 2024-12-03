<?php

namespace App\Exceptions;

use App\Consts\Messages\ExceptionMessages;
use Exception;

class NotFoundException extends CustomException
{
    public function __construct(string $message = ExceptionMessages::DATA_DOES_NOT_EXIST, $code = 404, ?Exception $previous = null, string $log_level = CustomException::LOG_LEVEL_ERROR)
    {
        parent::__construct($message, $code, $previous, $log_level);
    }
}
