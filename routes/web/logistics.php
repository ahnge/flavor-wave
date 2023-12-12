<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LogisticController;

Route::middleware(['admin', 'logistics'])->group(function () {

    Route::get('/', [LogisticController::class, "index"])->name("logistic.index");
    Route::get('/truck/{id}', [LogisticController::class, "orderAssign"])->name('logistic.orderAssign');
    Route::post('/truck', [LogisticController::class, "addOrderToTruck"])->name("logistic.addOrderToTruck");
});
