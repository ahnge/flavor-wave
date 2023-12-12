<?php

namespace App\Http\Controllers\Distributor\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Index extends Controller
{
    public function index(Request $request)
    {

        $products = \App\Models\Product::all();

        return view('web.distributor.home.index',compact('products'));
    }
}
