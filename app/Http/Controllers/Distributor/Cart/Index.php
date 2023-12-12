<?php

namespace App\Http\Controllers\Distributor\Cart;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Index extends Controller
{
    public  function  index(Request $request)
    {
        $cartIds = $request->query('cartList');
        $cartIds = explode(',',$cartIds);
        $products = \App\Models\Product::whereIn('id',$cartIds)->get();

        return view('web.distributor.cart.index',compact(['products']));
    }
}
