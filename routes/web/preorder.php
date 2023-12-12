<?php

use App\Http\Controllers\PreorderController;
use Illuminate\Support\Facades\Route;

Route::prefix("preorder")->controller(PreorderController::class)->group(function () {
    Route::get("lists", "preorderLists")->name("preorder.preorderList");
    Route::post("check-status", "checkStatus")->name("preorder.checkStatus");
});
