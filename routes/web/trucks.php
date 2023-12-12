<?php

use App\Http\Controllers\TruckController;
use Illuminate\Support\Facades\Route;

Route::middleware(['admin','logistics'])->group(function (){


    // Truck detail page
    Route::get('/trucks/{id}', [TruckController::class, 'show'])->name('trucks.show');

    // Update order status
    Route::put('/trucks/orders/{orderId}/update-status', [TruckController::class, 'updateOrderStatus']);


});
