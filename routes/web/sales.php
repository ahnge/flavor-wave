<?php

use App\Http\Controllers\PreorderController;
use App\Http\Controllers\SaleDistributorController;
use Illuminate\Support\Facades\Route;

Route::middleware(['admin', 'sales'])->group(function () {

    Route::controller(PreorderController::class)->group(function () {
        Route::get("preorders", "preorderLists")->name("preorder.preorderList");
        Route::post("preorders/check-status", "checkStatus")->name("preorder.checkStatus");
    });

    Route::controller(SaleDistributorController::class)->group(function(){
        Route::get("/distributors", "index")->name("sales.distributors.index");
        Route::get("/distributors/{id}", "show")->name("sales.distributors.show");
    });

    Route::get("preorders/charts", [PreorderController::class, "charts"])->name("preorders.charts");
    /* Route::get('/preorders/status/{status}',[PreorderController::class, 'filteredPreorderList'])->name('preorders.filteredPreorderList'); */
    Route::get('/preorders/{preorder}', [PreorderController::class, 'showOrder'])->name('preorder.edit');
    Route::post('/preorders/{preorder}', [PreorderController::class, 'changeOrderStatus'])->name('preorder.changeStatus');

});
