<?php

namespace App\Logging;

use Monolog\Formatter\FormatterInterface;
use Monolog\Formatter\JsonFormatter;

/**
 * AWS CloudWatch に送った時に見やすくなるように、ログをJsonで出力しつつ、
 * Stacktrace も出力するための Formatter
 */
class CustomJsonFormatter extends JsonFormatter implements FormatterInterface
{
    public function __construct($batchMode = self::BATCH_MODE_JSON, $appendNewline = true, bool $ignoreEmptyContextAndExtra = false)
    {
        // $includeStacktraces に強制的に true を指定する
        parent::__construct($batchMode, $appendNewline, $ignoreEmptyContextAndExtra, true);
    }
}
