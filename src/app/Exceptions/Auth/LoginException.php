<?php

namespace App\Exceptions\Auth;

use Exception;
use Illuminate\Http\JsonResponse;

class LoginException extends Exception
{
    public function render($request): JsonResponse
    {
        return response()->json(config('message.E_LOGIN_FAILED'), 401);
    }
}
