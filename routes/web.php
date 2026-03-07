<?php

use App\Http\Controllers\DeviceController;
use App\Http\Controllers\QuoteController;
use App\Http\Requests\BudgetItemsRequest;
use Illuminate\Foundation\Http\Middleware\HandlePrecognitiveRequests;
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

    Route::prefix('api')->name('api.')->group(function () {
        Route::get('/devices', [DeviceController::class, 'devices'])->name('devices');
        Route::get('/device/{device}', [DeviceController::class, 'device'])->name('device');
        Route::post('budget-items', function (BudgetItemsRequest $request) {})
            ->middleware([HandlePrecognitiveRequests::class])
            ->name('budget-items.validate');
    });

    Route::livewire('/dashboard', \App\Livewire\Dashboard::class)->name('dashboard');

    Route::prefix('cadastros')->group(function () {
        Route::prefix('marcas')->name('brands.')->group(function () {
            Route::livewire('/', \App\Livewire\Brands\Index::class)->name('index');
            Route::livewire('/adicionar', \App\Livewire\Brands\Create::class)->name('create');
            Route::livewire('/{brand}/editar', \App\Livewire\Brands\Edit::class)->name('edit');
        });

        Route::prefix('clientes')->name('clients.')->group(function () {
            Route::livewire('/', \App\Livewire\Clients\Index::class)->name('index');
            Route::livewire('/adicionar', \App\Livewire\Clients\Create::class)->name('create');
            Route::livewire('/{client}/editar', \App\Livewire\Clients\Edit::class)->name('edit');
        });

        Route::prefix('equipamentos')->name('devices.')->group(function () {
            Route::livewire('/', \App\Livewire\Devices\Index::class)->name('index');
            Route::livewire('/adicionar', \App\Livewire\Devices\Create::class)->name('create');
            Route::livewire('/{device}/editar', \App\Livewire\Devices\Edit::class)->name('edit');
        });
    });

    Route::prefix('os')->group(function () {
        Route::name('quotes.')->group(function () {
            Route::get('orcamentos', [QuoteController::class, 'index'])->name('index');
            Route::get('orcamentos/adicionar/', [QuoteController::class, 'create'])->name('create');
            Route::post('orcamentos', [QuoteController::class, 'store'])->name('store');
            Route::get('orcamentos/{budget}', [QuoteController::class, 'show'])->name('show');
            Route::get('orcamentos/{budget}/editar', [QuoteController::class, 'edit'])->name('edit');
            Route::put('orcamentos/{budget}', [QuoteController::class, 'update'])->name('update');
            Route::delete('orcamentos/{budget}', [QuoteController::class, 'destroy'])->name('destroy');

        });
    });
});
