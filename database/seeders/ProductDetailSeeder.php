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
                'sku' => 'SKU001',
                'size' => 'S',
                'price' => 150000,
                'quantity' => 10,
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'product_id' => 1,
                'sku' => 'SKU002',
                'size' => 'M',
                'price' => 155000,
                'quantity' => 8,
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'product_id' => 1,
                'sku' => 'SKU003',
                'size' => 'L',
                'price' => 160000,
                'quantity' => 6,
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'product_id' => 2,
                'sku' => 'SKU004',
                'size' => 'S',
                'price' => 145000,
                'quantity' => 9,
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'product_id' => 2,
                'sku' => 'SKU005',
                'size' => 'M',
                'price' => 150000,
                'quantity' => 7,
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'product_id' => 2,
                'sku' => 'SKU006',
                'size' => 'L',
                'price' => 155000,
                'quantity' => 5,
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'product_id' => 3,
                'sku' => 'SKU007',
                'size' => 'S',
                'price' => 170000,
                'quantity' => 12,
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'product_id' => 3,
                'sku' => 'SKU008',
                'size' => 'M',
                'price' => 175000,
                'quantity' => 10,
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'product_id' => 3,
                'sku' => 'SKU009',
                'size' => 'L',
                'price' => 180000,
                'quantity' => 8,
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}
