<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EchographyController;
use App\Http\Controllers\EchoTypeController;

Route::prefix('echo-type')->middleware(['auth'])->name('setting.echo-type.')->controller(EchoTypeController::class)->group(function () {
    Route::get('/', 'index')->name('index')->middleware('can:ViewAnyEchoType');
    Route::get('/create', 'create')->name('create')->middleware('can:CreateEchoType');
    Route::put('/store', 'store')->name('store')->middleware('can:CreateEchoType');
    Route::get('/{echoType}/edit', 'edit')->name('edit')->middleware('can:UpdateEchoType');
    Route::put('/{echoType}/update', 'update')->name('update')->middleware('can:UpdateEchoType');
    Route::delete('/{echoType}/delete', 'destroy')->name('delete')->middleware('can:DeleteEchoType');
    Route::put('/{ecgType}/restore', 'restore')->name('restore')->middleware('can:RestoreEchoType');
    Route::delete('/{ecgType}/force_delete', 'force_delete')->name('force_delete')->middleware('can:ForceDeleteEchoType');
    Route::get('/sort_order', 'sort_order')->name('sort_order')->middleware('can:UpdateEchoType');
    Route::post('/update_order', 'update_order')->name('update_order')->middleware('can:UpdateEchoType');
});

Route::prefix('echography')->middleware(['auth'])->name('para_clinic.echography.')->controller(EchographyController::class)->group(function () {
    Route::get('/', 'index')->name('index')->middleware('can:ViewAnyEchography');
    Route::get('/create', 'create')->name('create')->middleware('can:CreateEchography');
    Route::put('/store', 'store')->name('store')->middleware('can:CreateEchography');
    Route::get('/{echography}/edit', 'edit')->name('edit')->middleware('can:UpdateEchography');
    Route::put('/{echography}/update', 'update')->name('update')->middleware('can:UpdateEchography');
    Route::delete('/{echography}/delete', 'destroy')->name('delete')->middleware('can:DeleteEchography');
    Route::put('/{echography}/restore', 'restore')->name('restore')->middleware('can:RestoreEchography');
    Route::delete('/{echography}/force_delete', 'force_delete')->name('force_delete')->middleware('can:ForceDeleteEchography');
    Route::get('/{echography}/show', 'show')->name('show')->middleware('can:ViewAnyEchography');
    Route::get('/{echography}/print', 'print')->name('print')->middleware('can:PrintEchography');
    Route::post('/getDetail', 'getDetail')->name('getDetail');
});