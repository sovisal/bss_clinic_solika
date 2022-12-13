<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EcgController;
use App\Http\Controllers\EcgTypeController;

Route::middleware(['auth'])->name('setting.')->group(function () {
    Route::prefix('ecg-type')->name('ecg-type.')->group(function () {
        Route::get('/', [EcgTypeController::class, 'index'])->name('index')->middleware('can:ViewAnyEcgType');
        Route::get('/create', [EcgTypeController::class, 'create'])->name('create')->middleware('can:CreateEcgType');
        Route::put('/store', [EcgTypeController::class, 'store'])->name('store')->middleware('can:CreateEcgType');
        Route::get('/{ecgType}/edit', [EcgTypeController::class, 'edit'])->name('edit')->middleware('can:UpdateEcgType');
        Route::put('/{ecgType}/update', [EcgTypeController::class, 'update'])->name('update')->middleware('can:UpdateEcgType');
        Route::delete('/{ecgType}/delete', [EcgTypeController::class, 'destroy'])->name('delete')->middleware('can:DeleteEcgType');
        Route::put('/{ecgType}/restore', [EcgTypeController::class, 'restore'])->name('restore')->middleware('can:RestoreEcgType');
        Route::delete('/{ecgType}/force_delete', [EcgTypeController::class, 'force_delete'])->name('force_delete')->middleware('can:ForceDeleteEcgType');
		Route::get('/sort_order', [EcgTypeController::class, 'sort_order'])->name('sort_order');
		Route::post('/update_order', [EcgTypeController::class, 'update_order'])->name('update_order');

    });
});

Route::middleware(['auth'])->name('para_clinic.')->group(function () {
    Route::prefix('ecg')->group(function () {
        Route::get('/', [EcgController::class, 'index'])->name('ecg.index');
        Route::get('/create', [EcgController::class, 'create'])->name('ecg.create');
        Route::put('/store', [EcgController::class, 'store'])->name('ecg.store');
        Route::get('/{ecg}/print', [EcgController::class, 'print'])->name('ecg.print');
        Route::get('/{ecg}/edit', [EcgController::class, 'edit'])->name('ecg.edit');
        Route::get('/{ecg}/show', [EcgController::class, 'show'])->name('ecg.show');
        Route::put('/{ecg}/update', [EcgController::class, 'update'])->name('ecg.update');
        Route::delete('/{ecg}/delete', [EcgController::class, 'destroy'])->name('ecg.delete');
        Route::post('/getDetail', [EcgController::class, 'getDetail'])->name('ecg.getDetail');
    });
});