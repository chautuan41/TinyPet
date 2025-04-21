<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ProductTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('product_types')->insert([
            [
                'product_type_name' => 'Thức Ăn Hạt Cho Chó',
                'category_id' => 1,
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_type_name' => 'Thức Ăn Ướt Cho Chó',
                'category_id' => 2,
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_type_name' => 'Thức Ăn Hữu Cơ Cho Chó',
                'category_id' => 1,
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_type_name' => 'Thức Ăn Hạt Cho Mèo',
                'category_id' => 2,
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_type_name' => 'Thức Ăn Ướt Cho Mèo',
                'category_id' => 1,
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_type_name' => 'Bánh Thưởng Mèo',
                'category_id' => 2,
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_type_name' => 'Vòng Cổ - Dây Dắt',
                'category_id' => 3,
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
