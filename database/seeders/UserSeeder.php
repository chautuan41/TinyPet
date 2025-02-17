<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('users')->insert([
            [
                'name' => 'John Doe',
                'email' => 'john.doe@example.com',
                'email_verified_at' => Carbon::now(),
                'password' => bcrypt('123456'), // Mã hóa mật khẩu
                'role' => 1, // Giả sử 1 là quyền admin
               
            ],
            [
                'name' => 'Jane Smith',
                'email' => 'jane.smith@example.com',
                'email_verified_at' => Carbon::now(),
                'password' => bcrypt('123456'),
                'role' => 2, // Giả sử 2 là quyền người dùng
               
            ],
        ]);
    }
}
