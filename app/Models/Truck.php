<?php

namespace App\Models;


use App\Models\Order;
use App\Models\TruckOrders;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Truck extends Model
{
    use HasFactory;

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function truckOrders()
    {
        return $this->hasMany(TruckOrders::class);
    }
}
