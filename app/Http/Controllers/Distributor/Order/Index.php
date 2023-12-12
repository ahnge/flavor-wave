<?php

namespace App\Http\Controllers\Distributor\Order;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Index extends Controller
{
    public  function index()
    {

        $orders =
        \App\Models\Order::where('distributor_id',auth()->user()->id)
        ->orderBy('created_at','desc')
        ->orderBy('status','desc')
        ->with('products')
        ->paginate(10)
        ->withQueryString();

        return view('web.distributor.order.index',compact(['orders']));
    }
}
