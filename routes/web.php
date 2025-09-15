<?php

use App\Http\Controllers\ErpDashboardController;
use App\Http\Controllers\FinanceController;
use App\Http\Controllers\HumanResourcesController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\PurchasingController;
use App\Http\Controllers\SalesController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/health-check', function () {
    return response()->json([
        'status' => 'ok',
        'timestamp' => now()->toISOString(),
    ]);
})->name('health-check');

Route::get('/', function () {
    return Inertia::render('welcome');
})->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('dashboard', [ErpDashboardController::class, 'index'])->name('dashboard');
    
    // Inventory Management
    Route::controller(InventoryController::class)->prefix('inventory')->name('inventory.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/{product}', 'show')->name('show');
    });
    
    // Purchasing
    Route::controller(PurchasingController::class)->prefix('purchasing')->name('purchasing.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/{purchaseOrder}', 'show')->name('show');
    });
    
    // Sales
    Route::controller(SalesController::class)->prefix('sales')->name('sales.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/{salesOrder}', 'show')->name('show');
    });
    
    // Finance
    Route::controller(FinanceController::class)->prefix('finance')->name('finance.')->group(function () {
        Route::get('/', 'index')->name('index');
    });
    
    // Human Resources
    Route::controller(HumanResourcesController::class)->prefix('hr')->name('hr.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/{employee}', 'show')->name('show');
    });
});

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
