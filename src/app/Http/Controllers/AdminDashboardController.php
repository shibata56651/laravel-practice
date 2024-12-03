<?php

namespace App\Http\Controllers;

use App\Repositories\AdminRepositoryInterface;

class AdminDashboardController extends Controller
{
    protected $adminRepository;

    public function __construct(AdminRepositoryInterface $adminRepository)
    {
        $this->adminRepository = $adminRepository;
    }

    public function index()
    {

        $admins = $this->adminRepository->getAll();

        return view('dashboard', compact('admins'));
    }
}
