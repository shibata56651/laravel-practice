<?php

namespace App\Http\Api\Controllers;

use App\Http\Api\Requests\Auth\LoginRequest;
use App\Http\Api\Responses\Auth\LogoutResponse;
use App\Http\Services\AuthService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    private AuthService $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function login(LoginRequest $request): JsonResponse
    {
        $this->authService->login($request->validated());

        return response()->json()
            ->cookie(
                'idToken', $request->validated()['idToken']
            );
    }

    public function logout(Request $request): JsonResponse
    {
        $this->authService->logout($request);
        $response = new LogoutResponse();

        return $response->response();
    }
}
