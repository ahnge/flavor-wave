<?php

use App\Http\Controllers\PreorderController;
use Illuminate\Support\Facades\Route;

Route::middleware(['admin', 'sales'])->group(function () {

    Route::controller(PreorderController::class)->group(function () {
        Route::get("preorders", "preorderLists")->name("preorder.preorderList");
        Route::post("preorders/check-status", "checkStatus")->name("preorder.checkStatus");
    });

    Route::get("preorders/chart", [PreorderController::class, "chart"])->name("preorders.chart");
    Route::get('/preorders/status/{status}', [PreorderController::class, 'filteredPreorderList'])->name('preorders.filteredPreorderList');
    Route::get('/preorders/{preorder}', [PreorderController::class, 'showOrder'])->name('preorder.edit');
    Route::post('/preorders/{preorder}', [PreorderController::class, 'changeOrderStatus'])->name('preorder.changeStatus');
});
