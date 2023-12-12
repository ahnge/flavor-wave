<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TruckOrders extends Model
{
    use HasFactory;
    public function truck()
    {
        return $this->belongsTo(Truck::class);
    }
}
