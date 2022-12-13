<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EchographyController;
use App\Http\Controllers\EchoTypeController;

Route::middleware(['auth'])->name('setting.')->group(function () {
	Route::prefix('echo-type')->name('echo-type.')->group(function () {
		Route::get('/', [EchoTypeController::class, 'index'])->name('index')->middleware('can:ViewAnyEchoType');
		Route::get('/create', [EchoTypeController::class, 'create'])->name('create')->middleware('can:CreateEchoType');
		Route::put('/store', [EchoTypeController::class, 'store'])->name('store')->middleware('can:CreateEchoType');
		Route::get('/{echoType}/edit', [EchoTypeController::class, 'edit'])->name('edit')->middleware('can:UpdateEchoType');
		Route::put('/{echoType}/update', [EchoTypeController::class, 'update'])->name('update')->middleware('can:UpdateEchoType');
		Route::delete('/{echoType}/delete', [EchoTypeController::class, 'destroy'])->name('delete')->middleware('can:DeleteEchoType');
        Route::put('/{ecgType}/restore', [EchoTypeController::class, 'restore'])->name('restore')->middleware('can:RestoreEchoType');
        Route::delete('/{ecgType}/force_delete', [EchoTypeController::class, 'force_delete'])->name('force_delete')->middleware('can:ForceDeleteEchoType');
		Route::get('/sort_order', [EchoTypeController::class, 'sort_order'])->name('sort_order')->middleware('can:UpdateEchoType');
		Route::post('/update_order', [EchoTypeController::class, 'update_order'])->name('update_order')->middleware('can:UpdateEchoType');
	});
});

Route::middleware(['auth'])->name('para_clinic.')->group(function () {
	Route::prefix('echography')->group(function () {
		Route::get('/', [EchographyController::class, 'index'])->name('echography.index');
		Route::get('/create', [EchographyController::class, 'create'])->name('echography.create');
		Route::put('/store', [EchographyController::class, 'store'])->name('echography.store');
		Route::get('/{echography}/print', [EchographyController::class, 'print'])->name('echography.print');
		Route::get('/{echography}/edit', [EchographyController::class, 'edit'])->name('echography.edit');
		Route::get('/{echography}/show', [EchographyController::class, 'show'])->name('echography.show');
		Route::put('/{echography}/update', [EchographyController::class, 'update'])->name('echography.update');
		Route::delete('/{echography}/delete', [EchographyController::class, 'destroy'])->name('echography.delete');
		Route::post('/getDetail', [EchographyController::class, 'getDetail'])->name('echography.getDetail');
	});
});