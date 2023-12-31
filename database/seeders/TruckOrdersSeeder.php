<?php

namespace Database\Seeders;

use App\Constants\OrderStatusEnum;
use App\Models\Order;
use App\Models\Truck;
use App\Models\TruckOrders;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
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
        $orders = Order::whereIn('status', [OrderStatusEnum::Assigned->value, OrderStatusEnum::Shipped->value])->get();

        $endDate = Carbon::now()->addMonths(3);
        $startDate = Carbon::now()->subYears(2);
        $period = CarbonPeriod::create($startDate, $endDate);

        foreach ($trucks as $truck) {
            foreach ($period as $day) {

                // Get a random order from the existing orders
                $randomOrder = $orders->random();

                // Associate the random order with the truck using the pivot table (TruckOrder)
                TruckOrders::create([
                    'truck_id' => $truck->id,
                    'order_id' => $randomOrder->id,
                    'total_quantity' => rand(100, 500),
                    "created_at" => $day,
                    "updated_at" => $day
                ]);
            }
        }
    }
}
