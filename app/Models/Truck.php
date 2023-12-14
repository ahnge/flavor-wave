<?php

namespace App\Models;


use App\Models\Order;
use App\Models\TruckOrders;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Truck extends Model
{
    use HasFactory;

    protected $fillable = ["status"];

    public function orders()
    {
        return $this->belongsToMany(Order::class, 'truck_orders', 'truck_id', 'order_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }



    public function truckOrders()
    {
        return $this->hasMany(TruckOrders::class);
    }
}
