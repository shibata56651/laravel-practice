<?php

namespace App\Repositories;

use App\Domain\Entities\User;
use Illuminate\Support\Facades\DB;

class UserRepository implements UserRepositoryInterface
{
    public function findForLineID($line_id): User|false
    {
        $user = DB::table('users')->where('line_id', $line_id)->first();

        return empty($user) ? false : new User((array) $user);
    }

    public function insert($line_id, $name): User
    {
        $userId = DB::table('users')->insertGetId([
            'line_id' => $line_id,
            'name' => $name,
        ]);

        $user = DB::table('users')->find($userId);

        return new User((array) $user);
    }
}
