<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ServiceController;

Route::prefix('service')->name('invoice.service.')->controller(ServiceController::class)->group(function () {
	Route::get('/', 'index')->name('index')->middleware('can:ViewAnyService');
	Route::get('/create', 'create')->name('create')->middleware('can:CreateService');
	Route::post('/store', 'store')->name('store')->middleware('can:CreateService');
	Route::get('/{service}/edit', 'edit')->name('edit')->middleware('can:UpdateService');
    Route::put('/{service}/update', 'update')->name('update')->middleware('can:UpdateService');
    Route::delete('/{service}/delete', 'destroy')->name('delete')->middleware('can:DeleteService');
    Route::put('/{service}/restore', 'restore')->name('restore')->middleware('can:RestoreService');
    Route::delete('/{service}/force_delete', 'force_delete')->name('force_delete')->middleware('can:ForceDeleteService');

});