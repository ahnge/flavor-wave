<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
