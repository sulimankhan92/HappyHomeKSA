<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
//use App\Models\DeliveryTime;

class DeliveryTimesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $deliveryTimes = [
            ['time_slot' => '12 PM to 2 PM', 'urgent_basis' => false],
            ['time_slot' => '2 PM to 4 PM', 'urgent_basis' => false],
            ['time_slot' => '4 PM to 6 PM', 'urgent_basis' => false],
            ['time_slot' => '6 PM to 8 PM', 'urgent_basis' => false],
            ['time_slot' => 'One Hour', 'urgent_basis' => true],
        ];

        foreach ($deliveryTimes as $deliveryTime) {
//            DeliveryTime::create($deliveryTime);
        }
    }
}
