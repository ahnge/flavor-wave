<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data =[];
        for ($i=1; $i < 500; $i++) {
            $data[] = [
                'order_id' => $i + 1,
                'product_id' => rand(1,7),
                'quantity' => rand(1,100),
            ];
            $data[] = [
                'order_id' => $i + 1,
                'product_id' => rand(1,7),
                'quantity' => rand(1,100),
            ];
        }

        $chunks = array_chunk($data, 100);
        foreach ($chunks as $chunk) {
            \App\Models\OrderProduct::insert($chunk);
        }
    }
}
