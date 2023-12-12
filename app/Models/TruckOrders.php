<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TruckOrders extends Model
{

    public function truck()
    {
        return $this->belongsTo(Truck::class);
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
    use HasFactory;
}
