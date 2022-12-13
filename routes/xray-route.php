<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\XrayController;
use App\Http\Controllers\XrayTypeController;

Route::middleware(['auth'])->name('setting.')->group(function () {
	Route::prefix('xray-type')->name('xray-type.')->group(function () {
		Route::get('/', [XrayTypeController::class, 'index'])->name('index')->middleware('can:ViewAnyXRayType');
		Route::get('/create', [XrayTypeController::class, 'create'])->name('create')->middleware('can:CreateXRayType');
		Route::put('/store', [XrayTypeController::class, 'store'])->name('store')->middleware('can:CreateXRayType');
		Route::get('/{xrayType}/edit', [XrayTypeController::class, 'edit'])->name('edit')->middleware('can:UpdateXRayType');
		Route::put('/{xrayType}/update', [XrayTypeController::class, 'update'])->name('update')->middleware('can:UpdateXRayType');
		Route::delete('/{xrayType}/delete', [XrayTypeController::class, 'destroy'])->name('delete')->middleware('can:DeleteXRayType');
        Route::put('/{ecgType}/restore', [XrayTypeController::class, 'restore'])->name('restore')->middleware('can:RestoreXRayType');
        Route::delete('/{ecgType}/force_delete', [XrayTypeController::class, 'force_delete'])->name('force_delete')->middleware('can:ForceDeleteXRayType');
		Route::get('/sort_order', [XrayTypeController::class, 'sort_order'])->name('sort_order')->middleware('can:UpdateXRayType');
		Route::post('/update_order', [XrayTypeController::class, 'update_order'])->name('update_order')->middleware('can:UpdateXRayType');
	});
});

Route::middleware(['auth'])->name('para_clinic.')->group(function () {
	Route::prefix('xray')->group(function () {
		Route::get('/', [XrayController::class, 'index'])->name('xray.index');
		Route::get('/create', [XrayController::class, 'create'])->name('xray.create');
		Route::put('/store', [XrayController::class, 'store'])->name('xray.store');
		Route::get('/{xray}/print', [XrayController::class, 'print'])->name('xray.print');
		Route::get('/{xray}/edit', [XrayController::class, 'edit'])->name('xray.edit');
		Route::get('/{xray}/show', [XrayController::class, 'show'])->name('xray.show');
		Route::put('/{xray}/update', [XrayController::class, 'update'])->name('xray.update');
		Route::delete('/{xray}/delete', [XrayController::class, 'destroy'])->name('xray.delete');
		Route::post('/getDetail', [XrayController::class, 'getDetail'])->name('xray.getDetail');
	});
});