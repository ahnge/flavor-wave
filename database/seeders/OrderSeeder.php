<?php

namespace Database\Seeders;

use App\Constants\OrderStatusEnum;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $statusValues = collect(OrderStatusEnum::getValues())->pluck('value')->toArray();
        $data  =  [];

        for ($i = 1; $i <= 1000; $i++) {
            $status = $statusValues[$i % count($statusValues)];

            $data[] = [
                "order_no" =>  "ORD-" . str_pad($i, 5, '0', STR_PAD_LEFT),
                "status" =>  $status,
                "is_urgent" =>  rand(0, 1),
                "distributor_id" =>  rand(1, 10),
                'due_date' =>  now()->addDays(rand(1, 30))->format('Y-m-d'),
                'total' =>  rand(100000, 1000000),
                'completed_at' =>  null,
                "created_at" =>  now()->addDays(rand(1, 30))->format('Y-m-d'),
                'updated_at' =>  now()->addDays(rand(1, 30))->format('Y-m-d'),
            ];
        }

        $chunks = array_chunk($data, 100);
        foreach ($chunks as $chunk) {
            \App\Models\Order::insert($chunk);
        }
    }
}
