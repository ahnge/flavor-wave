<?php

use App\Constants\RoleEnum;
use App\Http\Controllers\PreorderController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TruckController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



Route::controller(PreorderController::class)->group(function () {
    Route::get("preorder", "preorderLists")->name("preorder.preorderList");
    Route::post("preorder/check-status", "checkStatus")->name("preorder.checkStatus");
});


Route::prefix('')
    ->group(function () {
        \App\Services\RouteFile\RouteHelper::includedRouteFiles(__DIR__ . '/web');
    });


// Truck detail page
Route::get('/trucks/{id}', [TruckController::class, 'show'])->name('trucks.show');

require __DIR__ . '/auth.php';
