<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('brands')->insert([
            [
                'brand_name' => 'No Brand',
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'brand_name' => 'Aatas',
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'brand_name' => 'Ganador',
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'brand_name' => 'Royal Canin',
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
