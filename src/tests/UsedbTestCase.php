<?php

namespace Tests;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\DB;

abstract class UsedbTestCase extends BaseTestCase
{
    use CreatesApplication;
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        $test_role = DB::table('roles')->where('id', 1)->first();
        if (empty($test_role)) {
            DB::table('roles')->insert([
                'name' => '運営者',
            ]);
        }

    }
}
