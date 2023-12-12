<?php

use App\Http\Controllers\Distributor\Home\Index;
use App\Http\Controllers\Distributor\Cart\Index as CartIndex;
use App\Http\Controllers\Distributor\Order\Index as OrderIndex;
use App\Mail\SendOrderAlert;
use Illuminate\Support\Facades\Route;


Route::middleware(['distributor'])->group(function (){
    Route::get('/', [Index::class,'index'])->middleware('notAdmin')->name("distributor.index");

    Route::get('/distributor/cart', [CartIndex::class,'index'])->name("distributor.cart.index");

    Route::post('/distributor/order', [CartIndex::class,'order'])->name("distributor.cart.order");

    Route::get('/distributor/order/list', [OrderIndex::class,'index'])->name("distributor.order.index");

});
use Illuminate\Support\Facades\Mail;

Route::get('/distributor/index', [Index::class,'index'])->name("distributor.index");


Route::get('/send/email',function(){
    Mail::to("htetshine.coin@gmail.com")->queue(new SendOrderAlert("ORD-1101","htetshine.htetmkk@gmail.com"));

    return  'successs';
});

Route::get('/email/view',function(){

    return  view('mail.order');
});

