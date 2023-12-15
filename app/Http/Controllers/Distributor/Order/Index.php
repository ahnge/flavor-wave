<?php

namespace App\Http\Controllers\Distributor\Order;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Index extends Controller
{
    public  function index(Request $request)
    {

        $status = $request->status;
        $orders = \App\Models\Order::search($request->search)
        ->where('distributor_id', auth()->user()->id)
        ->when($request->has('status'), function ($query) use ($status) {
            if ($status == "all") {
                return  ;
            } else if($status == "pending") {
                return $query->where('status',0);
            } else{
                return $query->where('status', $status);
            }
        })
        // ->orderBy('status','desc')
        // ->orderBy('created_at','asc')
        // order by created_at
        ->latest('id')
        ->with('products')
        ->paginate(10)
        ->withQueryString();

        return view('web.distributor.order.index',compact(['orders']));
    }

    public function show($id)
    {
        $order = \App\Models\Order::findOrFail($id) ?? abort(404);
        $order->load('orderProducts.product');


        if($order->distributor_id != auth()->user()->id)
        {
            abort(401);
        }


        return view('web.distributor.order.show',compact(['order']));
    }
}
