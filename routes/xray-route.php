<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\XrayController;
use App\Http\Controllers\XrayTypeController;

Route::prefix('xray-type')->middleware(['auth'])->name('setting.xray-type.')->controller(XrayTypeController::class)->group(function () {
    Route::get('/', 'index')->name('index')->middleware('can:ViewAnyXRayType');
    Route::get('/create', 'create')->name('create')->middleware('can:CreateXRayType');
    Route::put('/store', 'store')->name('store')->middleware('can:CreateXRayType');
    Route::get('/{xrayType}/edit', 'edit')->name('edit')->middleware('can:UpdateXRayType');
    Route::put('/{xrayType}/update', 'update')->name('update')->middleware('can:UpdateXRayType');
    Route::delete('/{xrayType}/delete', 'destroy')->name('delete')->middleware('can:DeleteXRayType');
    Route::put('/{ecgType}/restore', 'restore')->name('restore')->middleware('can:RestoreXRayType');
    Route::delete('/{ecgType}/force_delete', 'force_delete')->name('force_delete')->middleware('can:ForceDeleteXRayType');
    Route::get('/sort_order', 'sort_order')->name('sort_order')->middleware('can:UpdateXRayType');
    Route::post('/update_order', 'update_order')->name('update_order')->middleware('can:UpdateXRayType');
});

Route::prefix('xray')->middleware(['auth'])->name('para_clinic.xray.')->controller(XrayController::class)->group(function () {
    Route::get('/', 'index')->name('index')->middleware('can:ViewAnyXRay');
    Route::get('/create', 'create')->name('create')->middleware('can:CreateXRay');
    Route::post('/store', 'store')->name('store')->middleware('can:CreateXRay');
    Route::get('/{xray}/edit', 'edit')->name('edit')->middleware('can:UpdateXRay');
    Route::put('/{xray}/update', 'update')->name('update')->middleware('can:UpdateXRay');
    Route::delete('/{xray}/delete', 'destroy')->name('delete')->middleware('can:DeleteXRay');
    Route::put('/{xray}/restore', 'restore')->name('restore')->middleware('can:RestoreXRay');
    Route::delete('/{xray}/force_delete', 'force_delete')->name('force_delete')->middleware('can:ForceDeleteXRay');
    Route::get('/{xray}/print', 'print')->name('print')->middleware('can:PrintXRay');
    Route::get('/{xray}/show', 'show')->name('show')->middleware('can:ViewAnyXRay');
    Route::post('/getDetail', 'getDetail')->name('getDetail');
});
