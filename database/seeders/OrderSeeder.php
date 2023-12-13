<?php

namespace Database\Seeders;

use App\Constants\OrderStatusEnum;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /* Generate dates of 2 years. */
        $endDate = Carbon::now()->addMonths(3);
        $startDate = Carbon::now()->subYears(2);
        $period = CarbonPeriod::create($startDate, $endDate);
        // $statusValues = collect(OrderStatusEnum::getValues())->pluck('value')->toArray();
        $data  =  [];

        foreach ($period as $i=> $date) {
                // $status = $statusValues[$i % count($statusValues)];

                $data[] = [
                    "order_no" =>  "ORD-" . str_pad($i, 5, '0', STR_PAD_LEFT),
                    "status" =>  rand(0,5),
                    'region_code' => "MMR00".rand(1, 9),
                    "address" => fake()->address(),
                    "phone_no" => fake()->phoneNumber(),
                    "is_urgent" =>  rand(0, 1),
                    "distributor_id" =>  rand(1, 10),
                    'due_date' =>  now()->addDays(rand(1, 30))->format('Y-m-d'),
                    'total' =>  rand(100000, 1000000),
                    'completed_at' =>  null,
                    "created_at" =>  $date,
                    'updated_at' =>  $date,
                ];
        }


        $chunks = array_chunk($data, 50);
        foreach ($chunks as $chunk) {
            \App\Models\Order::insert($chunk);
        }
    }
}
