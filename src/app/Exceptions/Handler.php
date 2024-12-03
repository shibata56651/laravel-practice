<?php

namespace App\Exceptions;

use App\Exceptions\Auth\LoginException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Support\Facades\Log;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    public function report(Throwable $exception)
    {
        if ($exception instanceof CustomException) {
            $log_level = $exception->getLogLevel();
            if ($log_level === CustomException::LOG_LEVEL_ERROR) {
                Log::error($exception->getMessage(), ['exception' => $exception]);

                return;
            }
            if ($log_level === CustomException::LOG_LEVEL_WARNING) {
                Log::warning($exception->getMessage(), ['exception' => $exception]);

                return;
            }
            if ($log_level === CustomException::LOG_LEVEL_INFO) {
                Log::info($exception->getMessage(), ['exception' => $exception]);

                return;
            }
            if ($log_level === CustomException::LOG_LEVEL_DEBUG) {
                Log::debug($exception->getMessage(), ['exception' => $exception]);

                return;
            }
        } else {
            parent::report($exception);
        }
    }

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    public function render($request, Throwable $e)
    {
        if ($e instanceof LoginException) {
            return $e->render($request);
        }

        return parent::render($request, $e);
    }
}
