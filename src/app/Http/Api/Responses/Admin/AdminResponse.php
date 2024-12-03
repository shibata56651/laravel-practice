<?php

namespace App\Http\Api\Responses\Admin;

use App\Domain\Entities\Admin;
use App\Http\Api\Responses\BaseResponse;
use Illuminate\Http\JsonResponse;

class AdminResponse extends BaseResponse
{
    private $admin;

    public function __construct(Admin $admin)
    {
        $this->admin = $admin;
    }

    public function response(int $status = 200, array $data = []): JsonResponse
    {
        return parent::getResponse(
            $status,
            $this->admin->toArray(),
        );
    }
}
