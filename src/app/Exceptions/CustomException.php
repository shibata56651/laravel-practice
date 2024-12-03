<?php

namespace App\Exceptions;

use App\Consts\Messages\ExceptionMessages;
use Exception;

class CustomException extends Exception
{
    const LOG_LEVEL_ERROR = 'error';

    const LOG_LEVEL_WARNING = 'warning';

    const LOG_LEVEL_INFO = 'info';

    const LOG_LEVEL_DEBUG = 'debug';

    protected string $log_level;

    public function __construct($message = ExceptionMessages::SYSTEM_ERROR, $code = 500, ?Exception $previous = null, $log_level = self::LOG_LEVEL_ERROR)
    {
        $this->log_level = $log_level;
        parent::__construct($message, $code, $previous);
    }

    public function render()
    {
        return response()->json(['error' => $this->getMessage()], $this->getCode());
    }

    public function getLogLevel()
    {
        return $this->log_level;
    }
}
