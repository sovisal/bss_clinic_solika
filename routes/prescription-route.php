<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PrescriptionController;

Route::prefix('prescription')->name('prescription.')->controller(PrescriptionController::class)->group(function () {
	Route::get('/', 'index')->name('index')->middleware('can:ViewAnyPrescription');
	Route::get('/create', 'create')->name('create')->middleware('can:CreatePrescription');
	Route::put('/store', 'store')->name('store')->middleware('can:CreatePrescription');
	Route::get('/{echography}/print', 'print')->name('print')->middleware('can:PrintPrescription');
	Route::get('/{prescription}/edit', 'edit')->name('edit')->middleware('can:UpdatePrescription');
	Route::put('/{prescription}/update', 'update')->name('update')->middleware('can:UpdatePrescription');
	Route::delete('/{prescription}/delete', 'destroy')->name('delete')->middleware('can:DeletePrescription');
	Route::get('/{prescription}/show', 'show')->name('show')->middleware('can:ViewAnyPrescription');
	Route::post('/getSelect2', 'getSelect2')->name('getSelect2');
	Route::post('/getDetail', 'getDetail')->name('getDetail');
});