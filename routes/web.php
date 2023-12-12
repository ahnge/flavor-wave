<?php

use App\Constants\RoleEnum;
use App\Http\Controllers\PreorderController;
use App\Http\Controllers\LogisticController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TruckController;
use Illuminate\Support\Facades\Auth;
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
    if (Auth::guard('admin')->check()) {
        return redirect(Auth::guard('admin')->user()->getRedirectRoute());
    }
    return redirect()->route('products');
});


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('loggedIn')->name('dashboard');

/* Route::middleware('loggedIn')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
}); */



/* Route::controller(PreorderController::class)->group(function () {
    Route::get("preorder", "preorderLists")->name("preorder.preorderList");
    Route::post("preorder/check-status", "checkStatus")->name("preorder.checkStatus");
}); */


Route::prefix('')
    ->group(function () {
        \App\Services\RouteFile\RouteHelper::includedRouteFiles(__DIR__ . '/web');
    });




require __DIR__ . '/auth.php';
