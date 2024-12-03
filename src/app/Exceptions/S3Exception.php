<?php

namespace App\Exceptions;

use App\Consts\Messages\ExceptionMessages;
use Exception;

class S3Exception extends CustomException
{
    public function __construct(string $message = ExceptionMessages::S3_FAILED, $code = 500, ?Exception $previous = null, string $log_level = CustomException::LOG_LEVEL_ERROR)
    {
        parent::__construct($message, $code, $previous, $log_level);
    }
}
