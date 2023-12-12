<?php

use App\Constants\RoleEnum;
use App\Http\Controllers\LogisticController;
use App\Http\Controllers\ProfileController;
use App\Models\Permission;
use App\Models\Truck;
use App\Services\Authorization\UserPermissions;
use App\Services\DataSets\ProductData;
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

// shine  update

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

// logistic
Route::prefix('logistic')->group(function () {
    Route::get('/', [LogisticController::class, "index"]);
    Route::get('/truck/{id}', [LogisticController::class, "orderAssign"])->name('logistic.orderAssign');
    Route::get('/truck/truck-details/{id}', [LogisticController::class, "truckDetails"])->name('logistic.truckDetails');
    Route::post('/truck', [LogisticController::class, "addOrderToTruck"])->name("logistic.addOrderToTruck");
});




require __DIR__ . '/auth.php';
