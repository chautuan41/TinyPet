<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('images')->insert([
             [
                'image_path' => 'user/images/products/f1.png',
                'product_id' => 1,
                'status' => 1,
            ],
            [
                'image_path' => 'user/images/products/f2.png',
                'product_id' => 1,
                'status' => 1,
            ],
            [
                'image_path' => 'user/images/products/f3.png',
                'product_id' => 2,
                'status' => 1,
            ],
            [
                'image_path' => 'user/images/products/f4.png',
                'product_id' => 2,
                'status' => 1,
            ],
            [
                'image_path' => 'user/images/products/f5.png',
                'product_id' => 3,
                'status' => 1,
            ],
            [
                'image_path' => 'user/images/products/f6.png',
                'product_id' => 3,
                'status' => 1,
            ],
        ]);
    }
}
