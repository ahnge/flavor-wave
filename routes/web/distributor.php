<?php

use App\Http\Controllers\Distributor\Home\Index;
use App\Mail\SendOrderAlert;
use Illuminate\Support\Facades\Route;

Route::get('/', [Index::class,'index'])->middleware('notAdmin')->name("distributor.index");

Route::middleware(['distributor'])->group(function (){


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

