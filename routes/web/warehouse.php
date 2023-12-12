<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;


Route::get('/warehouse', function () {

    return redirect()->route('warehouse.productList');
});


Route::middleware(['admin', 'warehouse'])->group(function () {

    Route::prefix("warehouse")->controller(ProductController::class)->group(function () {
        Route::get("product-list", "productList")->name("warehouse.productList");
        Route::get("product-list/{product}", "show")->name("warehouse.productShow");
        Route::put("product-edit/{id}", "edit")->name("warehouse.productEdit");
    });

});
