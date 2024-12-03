<?php

namespace App\Http\Api\Responses\Auth;

use App\Http\Api\Responses\BaseResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class LogoutResponse extends BaseResponse
{
    public function __construct()
    {
    }

    public function response(int $status = Response::HTTP_OK, array $data = []): JsonResponse
    {
        return response()->json($data, $status);
    }
}
