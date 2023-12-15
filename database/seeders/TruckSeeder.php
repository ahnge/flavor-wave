<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TruckSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                "truck_no" => "2C/9800",
                "driver_name"  => "Driver Ko Kyaw",
                "user_id" => 6,
                'capacity' => 200,
            ],
            [
                "truck_no" => "4E/2400",
                "driver_name"  => "Htet Shine",
                "user_id" => 7,
                'capacity' => 1000,
            ],
            [
                "truck_no" => "5T/3100",
                "driver_name"  => "winstownwinn",
                "user_id" => 8,
                'capacity' => 600,
            ], [
                "truck_no" => "1Y/1100",
                "driver_name"  => "coin",
                "user_id" => 9,
                'capacity' => 200,
            ],
            [
                "truck_no" => "3W/2000",
                "driver_name"  => "flavorsale",
                "user_id" => 10,
                'capacity' => 400,
            ],

        ];

        \App\Models\Truck::insert($data);
    }
}
