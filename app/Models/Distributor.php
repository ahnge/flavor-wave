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
        return 'products';
    }

    public function preorder()
    {
        return $this->hasMany(Order::class);
    }
}
