<?php

namespace App\Repositories;

use App\Domain\Entities\Admin as AdminEntity;
use Illuminate\Support\Facades\DB;

class AdminRepository implements AdminRepositoryInterface
{
    public function get(int $id)
    {
        $admin = DB::table('admins')->find('id');

        return new AdminEntity($admin);
    }

    public function getAll()
    {
        $records = DB::table('admins')->get();
        $admins_array = [];

        foreach ($records as $record) {
            $admins_array[] = new AdminEntity((array) $record);
        }

        return $admins_array;
    }

    public function createTokenByEmail(string $email)
    {
        $admin = DB::table('admins')->where('email', $email)->get()->firstorfail();

        return $admin->createToken('auth_token')->plainTextToken;
    }
}
