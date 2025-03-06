<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('suppliers')->insert([
            [
                'supplier_name' => 'Royal canin',
                'supplier_address' => '123 Supplier Street',
                'supplier_phone' => '123-456-7890',
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'supplier_name' => 'Ganador',
                'supplier_address' => '456 Supplier Avenue',
                'supplier_phone' => '234-567-8901',
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'supplier_name' => 'Aatas',
                'supplier_address' => '789 Supplier Lane',
                'supplier_phone' => '345-678-9012',
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}
