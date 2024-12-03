<?php

namespace App\Http\Services;

use App\Domain\Entities\Admin;
use App\Repositories\AdminRepository;

class AdminService extends BaseService
{
    protected AdminRepository $adminRepository;

    public function __construct(AdminRepository $adminRepository)
    {
        $this->adminRepository = $adminRepository;
    }

    public function getDetail(array $request): Admin
    {
        $id = $request['user']['id'];

        return $this->adminRepository->get($id);
    }
}
