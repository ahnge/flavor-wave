<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [];
            /* Generate dates of 2 years. */
            $endDate = Carbon::now()->addMonths(3);
            $startDate = Carbon::now()->subYears(2);
            $period = CarbonPeriod::create($startDate, $endDate);
            foreach ($period as $i=>$date) {

                $data[] = [
                    'order_id' => $i + 1,
                    'product_id' => rand(1, 14),
                    'quantity' => rand(1, 100),
                    "created_at" => $date,
                    "updated_at" => $date,

                ];
                $data[] = [
                    'order_id' => $i + 1,
                    'product_id' => rand(1, 14),
                    'quantity' => rand(1, 100),
                    "created_at" => $date,
                    "updated_at" => $date
                ];
            }

        $chunks = array_chunk($data, 100);
        foreach ($chunks as $chunk) {
            \App\Models\OrderProduct::insert($chunk);
        }
    }
}
