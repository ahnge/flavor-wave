<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    public function products()
    {
        return $this->belongsToMany(Product::class, 'order_products', 'order_id', 'product_id')->withPivot('quantity');
    }

    public function truck()
    {
        return $this->belongsToMany(Truck::class, 'truck_orders', 'order_id', 'truck_id');
    }

    public function distributor()
    {
        return $this->belongsTo(Distributor::class);
    }
}
