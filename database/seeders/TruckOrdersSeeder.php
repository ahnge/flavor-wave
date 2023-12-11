<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\Truck;
use App\Models\TruckOrders;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TruckOrdersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $trucks = Truck::all();
        $orders = Order::all();

        foreach ($trucks as $truck) {
            // Get a random order from the existing orders
            $randomOrder = $orders->random();

            // Associate the random order with the truck using the pivot table (TruckOrder)
            TruckOrders::create([
                'truck_id' => $truck->id,
                'order_id' => $randomOrder->id,
            ]);
        }
    }
}
