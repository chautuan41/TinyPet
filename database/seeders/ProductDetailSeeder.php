<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ProductDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('product_details')->insert([
            [
                'product_id' => 1,
                'size' => 'S',
                'price' => 100,
                'quantity' => 50,
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => 1,
                'size' => 'M',
                'price' => 150,
                'quantity' => 30,
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [ 
                'product_id' => 1,
                'size' => 'L',
                'price' => 200,
                'quantity' => 20,
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => 2,
                'size' => 'S',
                'price' => 100,
                'quantity' => 50,
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => 2,
                'size' => 'M',
                'price' => 150,
                'quantity' => 30,
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [ 
                'product_id' => 2,
                'size' => 'L',
                'price' => 200,
                'quantity' => 20,
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => 3,
                'size' => 'S',
                'price' => 100,
                'quantity' => 50,
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => 3,
                'size' => 'M',
                'price' => 150,
                'quantity' => 30,
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [ 
                'product_id' => 3,
                'size' => 'L',
                'price' => 200,
                'quantity' => 20,
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
