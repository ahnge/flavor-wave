<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Truck extends Model
{
    protected $fillable = ["status"];

    public function orders()
    {
        return $this->belongsToMany(Order::class, 'truck_orders', 'truck_id', 'order_id');
    }

    use HasFactory;
}
