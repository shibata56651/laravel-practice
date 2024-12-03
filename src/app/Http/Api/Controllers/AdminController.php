<?php

namespace App\Http\Api\Controllers;

use App\Http\Api\Requests\Admin\ShowRequest;
use App\Http\Api\Responses\Admin\AdminResponse;
use App\Http\Services\AdminService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    private AdminService $adminService;

    public function __construct(AdminService $adminService)
    {
        $this->adminService = $adminService;
    }

    public function show(ShowRequest $request)
    {
        $admin = $this->adminService->getDetail($request->validated());

        $response = new AdminResponse($admin);

        return $response->response();
    }

    public function dummy($dummyId): JsonResponse
    {
        return response()->json([
            'id' => $dummyId,
            'name' => 'dummyName',
            'description' => 'dummy222',
        ], 200);
    }

    public function dummyPost(Request $request): JsonResponse
    {
        logger(json_encode($request->all()));

        return response()->json([
            'email' => $request->email,
            'name' => $request->name,
        ], 200);
    }
}
