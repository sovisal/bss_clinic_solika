<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EchographyController;
use App\Http\Controllers\EchoTypeController;

Route::middleware(['auth'])->name('setting.')->group(function () {
	Route::prefix('echo-type')->group(function () {
		Route::get('/', [EchoTypeController::class, 'index'])->name('echo-type.index');
		Route::get('/create', [EchoTypeController::class, 'create'])->name('echo-type.create');
		Route::put('/store', [EchoTypeController::class, 'store'])->name('echo-type.store');
		Route::get('/{echoType}/edit', [EchoTypeController::class, 'edit'])->name('echo-type.edit');
		Route::put('/{echoType}/update', [EchoTypeController::class, 'update'])->name('echo-type.update');
		Route::delete('/{echoType}/delete', [EchoTypeController::class, 'destroy'])->name('echo-type.delete');
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