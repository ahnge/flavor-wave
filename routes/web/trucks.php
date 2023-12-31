<?php

use App\Http\Controllers\TruckController;
use Illuminate\Support\Facades\Route;

Route::middleware(['admin', 'truck-driver'])->group(function () {


    // Truck detail page
    Route::get('/trucks/{truck_id}', [TruckController::class, 'show'])->name('trucks.show');

    // Order detail page
    Route::get('/trucks/{truck_id}/orders/{id}/detail', [TruckController::class, 'orderDetail'])->name('trucks.orderDetail');

    // Update order status
    Route::put('/trucks/{truck_id}/orders/{orderId}/update-status', [TruckController::class, 'updateOrderStatus']);

    // Update truck status
    Route::put('/trucks/{truck_id}', [TruckController::class, 'updateTruckStatus']);

    // Return order
    Route::put('/trucks/{truck_id}/orders/{order_id}/return', [TruckController::class, 'returnOrder'])->name('trucks.returnOrder');

    // Export assigned orders
    Route::get('/trucks/{truck_id}/export-orders', [TruckController::class, 'exportAssignedOrders'])->name('trucks.exportOrder');
});
