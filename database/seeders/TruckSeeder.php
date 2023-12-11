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
                "truck_no"=> "2C/9800",
                "driver_name"  => "Ko Aung Kyaw",
                'capacity' => 200,
            ],
            [
                "truck_no"=> "4E/2400",
                "driver_name"  => "U Hla Maung",
                'capacity' => 1000,
            ],
            [
                "truck_no"=> "5T/3100",
                "driver_name"  => "Ko Myo Thant",
                'capacity' => 600,
            ],[
                "truck_no"=> "1Y/1100",
                "driver_name"  => "U Myint Aung",
                'capacity' => 200,
            ],
            [
                "truck_no"=> "3W/2000",
                "driver_name"  => "Driver Ko Kyaw",
                'capacity' => 400,
            ],

        ];

        \App\Models\Truck::insert($data);
    }
}
