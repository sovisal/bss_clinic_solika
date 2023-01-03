<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\FourLevelAddressController;
use App\Http\Controllers\DataParentController;

Route::middleware(['auth'])->name('setting.')->group(function () {

    Route::prefix('setting')->middleware('can:DeveloperMode')->group(function () {
        Route::get('/', [HomeController::class, 'setting'])->name('edit');
        Route::put('/update', [HomeController::class, 'setting_update'])->name('update');
    });

    Route::prefix('address')->controller(FourLevelAddressController::class)->group(function () {
        Route::get('/', 'index')->name('address.index')->middleware('can:ViewAnyAddress');
        Route::get('/create', 'create')->name('address.create')->middleware('can:CreateAddress');
        Route::post('/store', 'store')->name('address.store')->middleware('can:CreateAddress');
        Route::get('/{province}/edit', 'edit')->name('address.edit')->middleware('can:UpdateAddress');
        Route::put('/{province}/update', 'update')->name('address.update')->middleware('can:UpdateAddress');
        Route::post('/getFullAddress', 'BSSFullAddress')->name('getFullAddress');
        Route::post('/getProvinceChileSelection', 'District')->name('getProvinceChileSelection');
        Route::post('/getDistrictChileSelection', 'Commune')->name('getDistrictChileSelection');
        Route::post('/getCommuneChileSelection', 'Village')->name('getCommuneChileSelection');
    });

    Route::prefix('data-parent')->name('data-parent.')->controller(DataParentController::class)->group(function () {
        Route::get('/', 'index')->name('index')->middleware('can:ViewAnyDataParent');
        Route::get('/create', 'create')->name('create')->middleware('can:CreateDataParent');
        Route::put('/store', 'store')->name('store')->middleware('can:CreateDataParent');
        Route::get('/{dataParent}/edit', 'edit')->name('edit')->middleware('can:UpdateDataParent');
        Route::put('/{dataParent}/update', 'update')->name('update')->middleware('can:UpdateDataParent');
        Route::delete('/{dataParent}/delete', 'destroy')->name('delete')->middleware('can:DeleteDataParent');
        Route::put('/{dataParent}/restore', 'restore')->name('restore')->middleware('can:RestoreDataParent');
        Route::delete('/{dataParent}/force_delete', 'force_delete')->name('force_delete')->middleware('can:ForceDeleteDataParent');
    });

    Route::prefix('doctor')->name('doctor.')->controller(DoctorController::class)->group(function () {
        Route::get('/', 'index')->name('index')->middleware('can:ViewAnyDoctor');
        Route::get('/create', 'create')->name('create')->middleware('can:CreateDoctor');
        Route::post('/store', 'store')->name('store')->middleware('can:CreateDoctor');
        Route::get('/{doctor}/edit', 'edit')->name('edit')->middleware('can:UpdateDoctor');
        Route::put('/{doctor}/update', 'update')->name('update')->middleware('can:UpdateDoctor');
        Route::delete('/{doctor}/delete', 'destroy')->name('delete')->middleware('can:DeleteDoctor');
        Route::get('/{doctor}/show', 'show')->name('show')->middleware('can:ViewAnyDoctor');
        Route::post('/getSelect2', 'getSelect2')->name('getSelect2');
    });

    Route::prefix('medicine')->name('medicine.')->controller(MedicineController::class)->group(function () {
        Route::get('/', 'index')->name('index')->middleware('can:ViewAnyMedicine');
        Route::get('/create', 'create')->name('create')->middleware('can:CreateMedicine');
        Route::post('/store', 'store')->name('store')->middleware('can:CreateMedicine');
        Route::get('/{medicine}/edit', 'edit')->name('edit')->middleware('can:UpdateMedicine');
        Route::put('/{medicine}/update', 'update')->name('update')->middleware('can:UpdateMedicine');
        Route::delete('/{medicine}/delete', 'destroy')->name('delete')->middleware('can:DeleteMedicine');
        Route::get('/{medicine}/show', 'show')->name('show')->middleware('can:ViewAnyMedicine');
        Route::post('/getSelect2', 'getSelect2')->name('getSelect2');
    });
});
