<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('roles')->insert([
            ['role_name' => 'Admin', 'status' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['role_name' => 'Nhân viên', 'status' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['role_name' => 'Khách hàng', 'status' => 1, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
