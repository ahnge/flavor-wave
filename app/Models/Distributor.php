<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Distributor extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'password',
        'address',
        'region_code',
        'phone_number'
    ];

    public function getRedirectRoute()
    {
        return 'distributor.index';
    }

    public function preorder()
    {
        return $this->hasMany(Order::class);
    }

    public function scopeSearch($query,$search){
        return $query->when($search,function($q) use ($search){
            return $q->where('name','like',"%$search%")
                ->orWhere('email','like',"%$search%")
                ->orWhere('phone_number','like',"%$search%");
        });
    }
}
