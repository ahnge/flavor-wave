<?php

namespace App\Models;

use App\Models\OrderProduct;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ["status"];

    protected $casts = [
        'due_date' => 'datetime:Y-m-d',
        'completed_at' => 'datetime:Y-m-d',
    ];

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

    public function totalProductQuantity()
    {
        $qty = 0;
        
        foreach($this->orderProducts as $product){
            $qty += $product->quantity;
        }

        return $qty;
    }

    public function scopeSearch($query, $search)
    {
        return $query->when($search, function ($query, $search) {
            return $query->where('order_no', 'like', '%' . $search . '%');
        });
    }

    public function trucks()
    {
        return $this->belongsToMany(Truck::class, 'truck_orders')
            ->withPivot('total_quantity')
            ->withTimestamps();
    }

    public function region()
    {
        return $this->belongsTo(Region::class, 'region_code', 'code');
    }
}
