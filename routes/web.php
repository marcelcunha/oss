<?php

use App\Http\Controllers\BrandController;
use App\Http\Controllers\BudgetController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DeviceController;
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

Route::redirect('/', 'login');

Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::prefix('cadastros')->group(function () {
        Route::prefix('marcas')->name('brands.')->group(function () {
            Route::get('/', [BrandController::class, 'index'])->name('index');
            Route::get('/adicionar', [BrandController::class, 'create'])->name('create');
            Route::post('/', [BrandController::class, 'store'])->name('store');
            Route::get('/{brand}/editar', [BrandController::class, 'edit'])->name('edit');
            Route::put('/{brand}', [BrandController::class, 'update'])->name('update');
            Route::delete('/{brand}', [BrandController::class, 'destroy'])->name('destroy');
        });

        Route::prefix('clientes')->name('clients.')->group(function () {
            Route::get('/', [ClientController::class, 'index'])->name('index');
            Route::get('/adicionar', [ClientController::class, 'create'])->name('create');
            Route::post('/', [ClientController::class, 'store'])->name('store');
            Route::get('/{client}', [ClientController::class, 'show'])->name('show');
            Route::get('/{client}/editar', [ClientController::class, 'edit'])->name('edit');
            Route::put('/{client}', [ClientController::class, 'update'])->name('update');
            Route::delete('/{client}', [ClientController::class, 'destroy'])->name('destroy');
        });

        Route::prefix('equipamentos')->name('devices.')->group(function () {
            Route::get('/', [DeviceController::class, 'index'])->name('index');
            Route::get('/adicionar', [DeviceController::class, 'create'])->name('create');
            Route::post('/', [DeviceController::class, 'store'])->name('store');
            Route::get('/{device}', [DeviceController::class, 'show'])->name('show');
            Route::get('/{device}/editar', [DeviceController::class, 'edit'])->name('edit');
            Route::put('/{device}', [DeviceController::class, 'update'])->name('update');
            Route::delete('/{device}', [DeviceController::class, 'destroy'])->name('destroy');
        });
    });

    Route::prefix('os')->group(function () {
        Route::resource('budgets', BudgetController::class);
    });

    Route::prefix('api')->name('api.')->group(function () {
        Route::get('/devices', [DeviceController::class, 'devices'])->name('devices');
        Route::get('/device/{device}', [DeviceController::class, 'device'])->name('device');
    });
});
