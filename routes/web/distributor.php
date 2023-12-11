<?php

use App\Http\Controllers\Distributor\Home\Index;
use Illuminate\Support\Facades\Route;

Route::get('/', [Index::class,'index'])->name("distributor.index");
