<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LaborItemController;
use App\Http\Controllers\LaborTypeController;

Route::middleware(['auth'])->name('setting.')->group(function () {
	Route::prefix('labor-type')->name('labor-type.')->group(function () {
		Route::get('/', [LaborTypeController::class, 'index'])->name('index');
		Route::get('/create', [LaborTypeController::class, 'create'])->name('create');
		Route::put('/store', [LaborTypeController::class, 'store'])->name('store');
		Route::get('/{laborType}/edit', [LaborTypeController::class, 'edit'])->name('edit');
		Route::put('/{laborType}/update', [LaborTypeController::class, 'update'])->name('update');
		Route::delete('/{laborType}/delete', [LaborTypeController::class, 'destroy'])->name('delete');
		Route::get('/sort_order', [LaborTypeController::class, 'sort_order'])->name('sort_order');
		Route::post('/update_order', [LaborTypeController::class, 'update_order'])->name('update_order');
	});

	Route::prefix('labor-item')->name('labor-item.')->group(function () {
		Route::get('/', [LaborItemController::class, 'index'])->name('index');
		Route::get('/create', [LaborItemController::class, 'create'])->name('create');
		Route::put('/store', [LaborItemController::class, 'store'])->name('store');
		Route::get('/{laborItem}/edit', [LaborItemController::class, 'edit'])->name('edit');
		Route::put('/{laborItem}/update', [LaborItemController::class, 'update'])->name('update');
		Route::delete('/{laborItem}/delete', [LaborItemController::class, 'destroy'])->name('delete');
		Route::get('/sort_order', [LaborItemController::class, 'sort_order'])->name('sort_order');
		Route::post('/update_order', [LaborItemController::class, 'update_order'])->name('update_order');
	});
});