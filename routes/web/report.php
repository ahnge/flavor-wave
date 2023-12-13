<?php

use App\Http\Controllers\ChartController;
use App\Http\Controllers\MonthlySaleController;
use App\Http\Controllers\WeeklySaleController;
use App\Http\Controllers\YearlySaleController;
use Illuminate\Support\Facades\Route;

Route::controller(WeeklySaleController::class)->group(function () {
    Route::get("weekly-sale", "weeklySale")->name("weeklySale.lists");
});


Route::controller(MonthlySaleController::class)->group(function () {
    Route::get("monthly-sale", "monthlySale")->name("monthlySale.lists");
});


Route::controller(YearlySaleController::class)->group(function () {
    Route::get("yearly-sale", "yearlySale")->name("yearlySale.lists");
});

Route::controller(ChartController::class)->group(function () {
    Route::get("product-sale", "productSale")->name("chart.productSale");
    Route::get("weekly-best-seller-product", "weeklyBestSellerProduct")->name("chart.weekly");
});
