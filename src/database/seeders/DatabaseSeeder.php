<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $test_role = DB::table('roles')->where('id', 1)->first();
        if (empty($test_role)) {
            DB::table('roles')->insert([
                'name' => '運営者',
            ]);
        }

        $test_admin = Admin::where('email', 'admin@bltinc.co.jp')->first();
        if (empty($test_admin)) {
            Admin::create([
                'role_id' => 1,
                'name' => 'BGテスト',
                'email' => 'admin@bltinc.co.jp',
                'password' => Hash::make('bltinc123'),
            ]);
        }
    }
}
