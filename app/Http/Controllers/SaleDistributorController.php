<?php

namespace App\Http\Controllers;

use App\Constants\OrderStatusEnum;
use App\Models\Distributor;
use App\Models\Order;
use Illuminate\Http\Request;

class SaleDistributorController extends Controller
{
    public function  index()
    {
        $distributors = Distributor::search(request('keyword'))->paginate(10)->withQueryString();

        return view('sales.distributors.index',compact('distributors'));
    }

    public function show($id)
    {
        $distributor = Distributor::findOrFail($id);
        $distributor->load('preorder');

        $orders = Order::where('distributor_id',$id)->paginate(10);

        $summary  =  [];
        $summaryOrders = $distributor->preorder->groupBy('status')->map(function($item){
            return $item->count();
        });

        $summary['total'] =  array_sum($summaryOrders->toArray());
        $summary['total_spent'] =  $distributor->preorder->where('status',OrderStatusEnum::Delivered->value)->sum('total');
        $summary['pending_orders'] =  $distributor->preorder->where('status',OrderStatusEnum::Pending->value)->count();
        $summary['approved_orders'] =  $distributor->preorder->where('status',OrderStatusEnum::Approved->value)->count();
        $summary['returned_orders'] =  $distributor->preorder->where('status',OrderStatusEnum::Returned->value)->count();


        return view('sales.distributors.show',compact('distributor','summary','orders'));
    }
}
