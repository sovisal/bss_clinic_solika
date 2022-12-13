<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LaboratoryController;
use App\Http\Controllers\LaborItemController;
use App\Http\Controllers\LaborTypeController;

Route::middleware(['auth'])->name('setting.')->group(function () {
    Route::prefix('labor-type')->name('labor-type.')->group(function () {
        Route::get('/', [LaborTypeController::class, 'index'])->name('index')->middleware('can:ViewAnyLaborType');
        Route::get('/create', [LaborTypeController::class, 'create'])->name('create')->middleware('can:CreateLaborType');
        Route::put('/store', [LaborTypeController::class, 'store'])->name('store')->middleware('can:CreateLaborType');
        Route::get('/{laborType}/edit', [LaborTypeController::class, 'edit'])->name('edit')->middleware('can:UpdateLaborType');
        Route::put('/{laborType}/update', [LaborTypeController::class, 'update'])->name('update')->middleware('can:UpdateLaborType');
        Route::delete('/{laborType}/delete', [LaborTypeController::class, 'destroy'])->name('delete')->middleware('can:DeleteLaborType');
        Route::put('/{laborType}/restore', [LaborTypeController::class, 'restore'])->name('restore')->middleware('can:RestoreLaborType');
        Route::delete('/{laborType}/force_delete', [LaborTypeController::class, 'force_delete'])->name('force_delete')->middleware('can:ForceDeleteLaborType');
        Route::get('/sort_order', [LaborTypeController::class, 'sort_order'])->name('sort_order');
        Route::post('/update_order', [LaborTypeController::class, 'update_order'])->name('update_order');
    });

    Route::prefix('labor-item')->name('labor-item.')->group(function () {
        Route::get('/{laborType}', [LaborItemController::class, 'index'])->name('index');
        Route::get('/{laborType}/create', [LaborItemController::class, 'create'])->name('create');
        Route::put('/{laborType}/store', [LaborItemController::class, 'store'])->name('store');
        Route::get('/{laborType}/{laborItem}/edit', [LaborItemController::class, 'edit'])->name('edit');
        Route::put('/{laborType}/{laborItem}/update', [LaborItemController::class, 'update'])->name('update');
        Route::delete('/{laborType}/{laborItem}/delete', [LaborItemController::class, 'destroy'])->name('delete');
        Route::get('/sort_order', [LaborItemController::class, 'sort_order'])->name('sort_order');
        Route::post('/update_order', [LaborItemController::class, 'update_order'])->name('update_order');
    });
});

Route::middleware(['auth'])->name('para_clinic.')->group(function () {
    Route::prefix('labor')->group(function () {
        Route::get('/', [LaboratoryController::class, 'index'])->name('labor.index');
        Route::get('/create', [LaboratoryController::class, 'create'])->name('labor.create');
        Route::put('/store', [LaboratoryController::class, 'store'])->name('labor.store');
        Route::get('/{labor}/print', [LaboratoryController::class, 'print'])->name('labor.print');
        Route::get('/{labor}/edit', [LaboratoryController::class, 'edit'])->name('labor.edit');
        Route::get('/{labor}/show', [LaboratoryController::class, 'show'])->name('labor.show');
        Route::put('/{labor}/update', [LaboratoryController::class, 'update'])->name('labor.update');
        Route::delete('/{labor}/delete', [LaboratoryController::class, 'destroy'])->name('labor.delete');
        Route::post('/getDetail', [LaboratoryController::class, 'getDetail'])->name('labor.getDetail');
    });
});
