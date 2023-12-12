<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LogisticController;

Route::middleware(['admin', 'logistics'])->group(function () {

    Route::get('/logistics', [LogisticController::class, "index"])->name("logistic.index");
    Route::get('/trucks/{id}/orders', [LogisticController::class, "orderAssign"])->name('logistic.orderAssign');
    Route::post('/trucks/{id}/orders', [LogisticController::class, "addOrderToTruck"])->name("logistic.addOrderToTruck");
});
