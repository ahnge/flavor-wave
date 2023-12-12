<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::prefix("warehouse")->controller(ProductController::class)->group(function () {
    Route::get("product-list", "productList")->name("warehouse.productList");
    Route::put("product-edit/{id}", "edit")->name("warehouse.productEdit");
});
