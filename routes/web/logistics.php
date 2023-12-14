<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LogisticController;
use App\Http\Controllers\PreorderController;
use App\Http\Controllers\TruckController;
use App\Models\Order;

Route::middleware(['admin', 'logistics'])->group(function () {

    Route::get('/logistics', [LogisticController::class, "index"])->name("logistic.index");
    Route::get('/trucks/{id}/orders', [LogisticController::class, "orderAssign"])->name('logistic.orderAssign');
    Route::post('/trucks/{id}/orders', [LogisticController::class, "addOrderToTruck"])->name("logistic.addOrderToTruck");
    // Logistic order detail page
    Route::get('/logistscs/{truck_id}/orders/{id}/detail', [LogisticController::class, 'orderDetail'])->name('logistic.orderDetail');
});
