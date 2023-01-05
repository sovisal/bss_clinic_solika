<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LaboratoryController;
use App\Http\Controllers\LaborItemController;
use App\Http\Controllers\LaborTypeController;

Route::middleware(['auth'])->name('setting.')->group(function () {
    Route::prefix('labor-type')->name('labor-type.')->controller(LaborTypeController::class)->group(function () {
        Route::get('/', 'index')->name('index')->middleware('can:ViewAnyLaborType');
        Route::get('/create', 'create')->name('create')->middleware('can:CreateLaborType');
        Route::post('/store', 'store')->name('store')->middleware('can:CreateLaborType');
        Route::get('/{laborType}/edit', 'edit')->name('edit')->middleware('can:UpdateLaborType');
        Route::put('/{laborType}/update', 'update')->name('update')->middleware('can:UpdateLaborType');
        Route::delete('/{laborType}/delete', 'destroy')->name('delete')->middleware('can:DeleteLaborType');
        Route::put('/{laborType}/restore', 'restore')->name('restore')->middleware('can:RestoreLaborType');
        Route::delete('/{laborType}/force_delete', 'force_delete')->name('force_delete')->middleware('can:ForceDeleteLaborType');
        Route::get('/sort_order', 'sort_order')->name('sort_order')->middleware('can:UpdateLaborType');
        Route::post('/update_order', 'update_order')->name('update_order')->middleware('can:UpdateLaborType');
    });

    Route::prefix('labor-item')->name('labor-item.')->controller(LaborItemController::class)->group(function () {
        Route::get('/{laborType}', 'index')->name('index')->middleware('can:ViewAnyLaborItem');
        Route::get('/{laborType}/create', 'create')->name('create')->middleware('can:CreateLaborItem');
        Route::post('/{laborType}/store', 'store')->name('store')->middleware('can:CreateLaborItem');
        Route::get('/{laborType}/{laborItem}/edit', 'edit')->name('edit')->middleware('can:UpdateLaborItem');
        Route::put('/{laborType}/{laborItem}/update', 'update')->name('update')->middleware('can:UpdateLaborItem');
        Route::delete('/{laborType}/{laborItem}/delete', 'destroy')->name('delete')->middleware('can:DeleteLaborItem');
        Route::put('/{laborItem}/restore', 'restore')->name('restore')->middleware('can:RestoreLaborItem');
        Route::delete('/{laborItem}/force_delete', 'force_delete')->name('force_delete')->middleware('can:ForceDeleteLaborItem');
        Route::get('/{laborType}/sort_order', 'sort_order')->name('sort_order')->middleware('can:UpdateLaborItem');
        Route::post('/{laborType}/update_order', 'update_order')->name('update_order')->middleware('can:UpdateLaborItem');
    });
});

Route::prefix('labor')->middleware(['auth'])->name('para_clinic.labor.')->controller(LaboratoryController::class)->group(function () {
    Route::get('/', 'index')->name('index')->middleware('can:ViewAnyLaboratory');
    Route::get('/create', 'create')->name('create')->middleware('can:CreateLaboratory');
    Route::post('/store', 'store')->name('store')->middleware('can:CreateLaboratory');
    Route::get('/{labor}/edit', 'edit')->name('edit')->middleware('can:UpdateLaboratory');
    Route::put('/{labor}/update', 'update')->name('update')->middleware('can:UpdateLaboratory');
    Route::delete('/{labor}/delete', 'destroy')->name('delete')->middleware('can:DeleteLaboratory');
    Route::put('/{labor}/restore', 'restore')->name('restore')->middleware('can:RestoreLaboratory');
    Route::delete('/{labor}/force_delete', 'force_delete')->name('force_delete')->middleware('can:ForceDeleteLaboratory');
    Route::get('/{labor}/print', 'print')->name('print')->middleware('can:PrintLaboratory');
    Route::post('/getDetail', 'getDetail')->name('getDetail');
});
