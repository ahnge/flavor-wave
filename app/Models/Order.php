<?php

namespace App\Models;

use App\Models\OrderProduct;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ["status"];

    public function distributor()
    {
        return $this->belongsTo(Distributor::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'order_products')->withPivot('quantity');
    }

    public function orderProducts()
    {
        return $this->hasMany(OrderProduct::class);
    }

}
