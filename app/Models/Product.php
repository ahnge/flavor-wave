<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'price',
        'product_photo',
        'pc_per_box',
        'total_box_count',
        'available_box_count',
        'reserving_box_count',
    ];

    public function orders()
    {
        return $this->belongsToMany(Order::class, 'order_products', 'product_id', 'order_id')->withPivot('quantity');
    }

    public function product()
    {
        return $this->hasMany(OrderProduct::class);
    }


    // public function productSaleAmount()
    // {
    //     return $this->hasManyThrough(Order::class, OrderProduct::class);
    // }
}
