<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EcgController;
use App\Http\Controllers\EcgTypeController;

Route::prefix('ecg-type')->middleware(['auth'])->name('setting.ecg-type.')->controller(EcgTypeController::class)->group(function () {
    Route::get('/', 'index')->name('index')->middleware('can:ViewAnyEcgType');
    Route::get('/create', 'create')->name('create')->middleware('can:CreateEcgType');
    Route::put('/store', 'store')->name('store')->middleware('can:CreateEcgType');
    Route::get('/{ecgType}/edit', 'edit')->name('edit')->middleware('can:UpdateEcgType');
    Route::put('/{ecgType}/update', 'update')->name('update')->middleware('can:UpdateEcgType');
    Route::delete('/{ecgType}/delete', 'destroy')->name('delete')->middleware('can:DeleteEcgType');
    Route::put('/{ecgType}/restore', 'restore')->name('restore')->middleware('can:RestoreEcgType');
    Route::delete('/{ecgType}/force_delete', 'force_delete')->name('force_delete')->middleware('can:ForceDeleteEcgType');
    Route::get('/sort_order', 'sort_order')->name('sort_order')->middleware('can:UpdateEcgType');
    Route::post('/update_order', 'update_order')->name('update_order')->middleware('can:UpdateEcgType');
});

Route::prefix('ecg')->middleware(['auth'])->name('para_clinic.ecg.')->controller(EcgController::class)->group(function () {
    Route::get('/', 'index')->name('index')->middleware('can:ViewAnyEcg');
    Route::get('/create', 'create')->name('create')->middleware('can:CreateEcg');
    Route::post('/store', 'store')->name('store')->middleware('can:CreateEcg');
    Route::get('/{ecg}/edit', 'edit')->name('edit')->middleware('can:UpdateEcg');
    Route::put('/{ecg}/update', 'update')->name('update')->middleware('can:UpdateEcg');
    Route::delete('/{ecg}/delete', 'destroy')->name('delete')->middleware('can:DeleteEcg');
    Route::put('/{ecg}/restore', 'restore')->name('restore')->middleware('can:RestoreEcg');
    Route::delete('/{ecg}/force_delete', 'force_delete')->name('force_delete')->middleware('can:ForceDeleteEcg');
    Route::get('/{ecg}/print', 'print')->name('print')->middleware('can:PrintEcg');
    Route::get('/{ecg}/show', 'show')->name('show')->middleware('can:ViewAnyEcg');
    Route::post('/getDetail', 'getDetail')->name('getDetail');
});