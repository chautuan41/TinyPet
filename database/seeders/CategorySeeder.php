<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('categories')->insert([
            ['category_name' => 'Thức ăn cho chó', 'status' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['category_name' => 'Thức ăn cho mèo', 'status' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['category_name' => 'Phụ kiện', 'status' => 1, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}