<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\MedicineController;
use App\Http\Controllers\FourLevelAddressController;

Route::middleware(['auth'])->name('inventory.')->group(function () {
	
	Route::prefix('inventory')->middleware(['can:DeveloperMode'])->group(function () {
		Route::get('/', [HomeController::class, 'setting'])->name('edit');
		Route::get('/doctor', [HomeController::class, 'setting'])->name('doctor.index');
		Route::put('/update', [HomeController::class, 'setting_update'])->name('update');
	});
});