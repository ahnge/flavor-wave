<?php

use App\Constants\OrderStatusEnum;
use App\Exports\TruckOrderAssign;
use Illuminate\Support\Facades\Mail;

use App\Http\Controllers\Distributor\Home\Index;
use App\Http\Controllers\Distributor\Cart\Index as CartIndex;
use App\Http\Controllers\Distributor\Order\Index as OrderIndex;
use App\Jobs\AssignTruckOrder;
use App\Mail\SendOrderAlert;
use App\Models\Order;
use App\Models\Truck;
use App\Models\TruckOrders;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;

Route::middleware(['distributor'])->group(function (){
    Route::get('/', [Index::class,'index'])->middleware('notAdmin')->name("distributor.index");

    Route::get('/distributor/cart', [CartIndex::class,'index'])->name("distributor.cart.index");

    Route::post('/distributor/order', [CartIndex::class,'order'])->name("distributor.cart.order");

    Route::get('/distributor/order/list', [OrderIndex::class,'index'])->name("distributor.order.index");
    Route::get('/distributor/order/list/{id}', [OrderIndex::class,'show'])->name("distributor.order.show");

});

Route::get('/distributor/index', [Index::class,'index'])->name("distributor.index");


Route::get('/send/email',function(){
    Mail::to("htetshine.coin@gmail.com")->queue(new SendOrderAlert("ORD-1101","htetshine.htetmkk@gmail.com"));

    return  'successs';
});

Route::get('/email/view',function(){

    return  view('mail.order');
});
Route::get('/export/excel',function(){

      (new AssignTruckOrder())->dispatch();
      return 'success';
});


Route::get('/test',function(){
        $driver = User::where("role_id",6)->pluck('id');

        $truckOrders = TruckOrders::select('truck_id', DB::raw('GROUP_CONCAT(order_id) as order_ids'))
        ->groupBy('truck_id')
        ->get();

        $truckIds = $truckOrders->pluck('truck_id');

        $trucks = Truck::
        whereIn('id',$truckIds)
        ->with('user')->get();
        $orders  =[];

        foreach($trucks as  $i=> $truck){
            $orders  = Order::whereIn('id',explode(',',$truckOrders->where('truck_id',$truck->id)->first()->order_ids))->where('status',OrderStatusEnum::Assigned->value)->get();

            Excel::store(new TruckOrderAssign($orders),'public/pdf/'. now()->format('dmY') .'/' . ($truck->user->id  ?? 'unknown' ). '-orders.pdf');

        }

        return 'success';


        // $truckOrders is now a collection where each item contains truck_id and order_ids

        return $truck;

        // $orders = Order::whereIn('id',$truckOrders)->where('status',OrderStatusEnum::Assigned->value)->groupBy();

        // return  $orders;

    // return $driver;
});
