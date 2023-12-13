<?php

use App\Http\Controllers\DailySaleController;
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
