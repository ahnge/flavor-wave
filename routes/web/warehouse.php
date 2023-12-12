<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;


Route::middleware(['admin', 'warehouse'])->prefix("warehouse")->group(function () {
    Route::get("product-list", [ProductController::class, 'productList'])->name("warehouse.productList");
    Route::put("product-edit/{id}", [ProductController::class, 'edit'])->name("warehouse.productEdit");
});
