<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
