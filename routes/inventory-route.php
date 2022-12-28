<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\StockInController;
use App\Http\Controllers\StockOutController;
use App\Http\Controllers\StockAlertController;
use App\Http\Controllers\StockBalanceController;
use App\Http\Controllers\StockAdjustmentController;

Route::middleware(['auth'])->name('inventory.')->group(function () {
	
	Route::prefix('inventory')->middleware(['can:DeveloperMode'])->group(function () {
		Route::get('/', [HomeController::class, 'setting'])->name('edit');
		Route::get('/doctor', [HomeController::class, 'setting'])->name('doctor.index');
		Route::put('/update', [HomeController::class, 'setting_update'])->name('update');
	});


    Route::prefix('stock_in')->name('stock_in.')->controller(StockInController::class)->group(function () {
        Route::get('/', 'index')->name('index')->middleware('can:ViewAnyStockIn');
        Route::get('/create', 'create')->name('create')->middleware('can:CreateStockIn');
        Route::post('/store', 'store')->name('store')->middleware('can:CreateStockIn');
        Route::get('/{stockIn}/edit', 'edit')->name('edit')->middleware('can:UpdateStockIn');
        Route::put('/{stockIn}/update', 'update')->name('update')->middleware('can:UpdateStockIn');
        Route::delete('/{stockIn}/delete', 'destroy')->name('delete')->middleware('can:DeleteStockIn');
        Route::put('/{stockIn}/restore', 'restore')->name('restore')->middleware('can:RestoreStockIn');
        Route::delete('/{stockIn}/force_delete', 'force_delete')->name('force_delete')->middleware('can:ForceDeleteStockIn');
    });

    Route::prefix('stock_out')->name('stock_out.')->controller(StockOutController::class)->group(function () {
        Route::get('/', 'index')->name('index')->middleware('can:ViewAnyStockOut');
        Route::get('/create', 'create')->name('create')->middleware('can:CreateStockOut');
        Route::post('/store', 'store')->name('store')->middleware('can:CreateStockOut');
        Route::get('/{stockOut}/edit', 'edit')->name('edit')->middleware('can:UpdateStockOut');
        Route::put('/{stockOut}/update', 'update')->name('update')->middleware('can:UpdateStockOut');
        Route::delete('/{stockOut}/delete', 'destroy')->name('delete')->middleware('can:DeleteStockOut');
        Route::put('/{stockOut}/restore', 'restore')->name('restore')->middleware('can:RestoreStockOut');
        Route::delete('/{stockOut}/force_delete', 'force_delete')->name('force_delete')->middleware('can:ForceDeleteStockOut');
    });

    Route::prefix('stock_adjustment')->name('stock_adjustment.')->controller(StockAdjustmentController::class)->group(function () {
        Route::get('/', 'index')->name('index')->middleware('can:ViewAnyStockAdjustment');
        Route::get('/create', 'create')->name('create')->middleware('can:CreateStockAdjustment');
        Route::post('/store', 'store')->name('store')->middleware('can:CreateStockAdjustment');
        Route::get('/{stockAdjustment}/edit', 'edit')->name('edit')->middleware('can:UpdateStockAdjustment');
        Route::put('/{stockAdjustment}/update', 'update')->name('update')->middleware('can:UpdateStockAdjustment');
        Route::delete('/{stockAdjustment}/delete', 'destroy')->name('delete')->middleware('can:DeleteStockAdjustment');
        Route::put('/{stockAdjustment}/restore', 'restore')->name('restore')->middleware('can:RestoreStockAdjustment');
        Route::delete('/{stockAdjustment}/force_delete', 'force_delete')->name('force_delete')->middleware('can:ForceDeleteStockAdjustment');
    });

    Route::get('stock_balance/', [StockBalanceController::class, 'index'])->name('stock_balance.index')->middleware('can:ViewStockBalance');
    Route::get('stock_alert', [StockAlertController::class, 'index'])->name('stock_alert.index')->middleware('can:ViewStockAlert');
});