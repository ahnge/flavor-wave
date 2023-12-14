<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;


Route::get('/warehouse', function () {

    return redirect()->route('warehouse.productList');
});


Route::middleware(['admin', 'warehouse'])->group(function () {

    Route::prefix("warehouse")->controller(ProductController::class)->group(function () {
        Route::get("product-list", "productList")->name("warehouse.productList");
        Route::get('product/charts', "charts")->name("warehouse.charts");
        Route::get("product-list/{product}/quantity", "changeQty")->name("warehouse.productQtyChange");
        Route::get("product-list/{product}/details", "showInfo")->name("warehouse.productShow");
        Route::post("product-list/{product}/details", "editDetails")->name("warehouse.productDetailChange");
        Route::put("product-edit/{id}", "edit")->name("warehouse.productEdit");
        // To create new product
        Route::get('/products/create', [ProductController::class, 'create'])->name('warehouse.createProduct');
        Route::post('/products', [ProductController::class, 'store'])->name('warehouse.storeProduct');
        // To update product box count with excel import
        Route::post('/import-box-counts', [ProductController::class, 'import'])->name('warehouse.importProductBoxCount');
        Route::get('/export-products', [ProductController::class, 'exportProducts'])->name('warehouse.exportProducts');
    });
});
