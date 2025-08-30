<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductPackingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $packagingLevels = [
            ['packaging_level' => 'Cotton', 'quantity' => 1, 'conversion_rate' => 1.00, 'status' => 1],
            ['packaging_level' => 'Dozen', 'quantity' => 12, 'conversion_rate' => 12.00, 'status' => 1],
            ['packaging_level' => '6 pieces', 'quantity' => 6, 'conversion_rate' => 6.00, 'status' => 1],
            ['packaging_level' => 'Single piece', 'quantity' => 1, 'conversion_rate' => 1.00, 'status' => 1],
            ['packaging_level' => 'Bundle', 'quantity' => 10, 'conversion_rate' => 10.00, 'status' => 1],
            ['packaging_level' => 'Pack of 3', 'quantity' => 3, 'conversion_rate' => 3.00, 'status' => 1],
            ['packaging_level' => 'Pack of 5', 'quantity' => 5, 'conversion_rate' => 5.00, 'status' => 1],
            ['packaging_level' => 'Box', 'quantity' => 20, 'conversion_rate' => 20.00, 'status' => 1],
            ['packaging_level' => 'Case', 'quantity' => 24, 'conversion_rate' => 24.00, 'status' => 1],
            ['packaging_level' => 'Pallet', 'quantity' => 50, 'conversion_rate' => 50.00, 'status' => 1],
            ['packaging_level' => 'Set', 'quantity' => 2, 'conversion_rate' => 2.00, 'status' => 1],
            ['packaging_level' => 'Pair', 'quantity' => 2, 'conversion_rate' => 2.00, 'status' => 1],
            ['packaging_level' => 'Gross (144 pieces)', 'quantity' => 144, 'conversion_rate' => 144.00, 'status' => 1],
            ['packaging_level' => 'Carton', 'quantity' => 30, 'conversion_rate' => 30.00, 'status' => 1],
            ['packaging_level' => 'Bag', 'quantity' => 40, 'conversion_rate' => 40.00, 'status' => 1],
        ];

        foreach ($packagingLevels as $level) {
            DB::table('product_packings')->insert(array_merge($level, [
                'created_by' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ]));
        }
    }
}
