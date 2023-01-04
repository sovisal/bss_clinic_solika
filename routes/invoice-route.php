<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InvoiceController as InvCon;

Route::prefix('invoice')->name('invoice.')->controller(InvCon::class)->group(function () {
	Route::get('/', 'index')->name('index')->middleware('can:ViewAnyInvoice');
	Route::get('/create', 'create')->name('create')->middleware('can:CreateInvoice');
	Route::put('/store', 'store')->name('store')->middleware('can:CreateInvoice');
	Route::get('/{invoice}/edit', 'edit')->name('edit')->middleware('can:UpdateInvoice');
	Route::put('/{invoice}/update', 'update')->name('update')->middleware('can:UpdateInvoice');
	Route::delete('/{invoice}/delete', 'destroy')->name('delete')->middleware('can:DeleteInvoice');
    Route::put('/{id}/restore', 'restore')->name('restore')->middleware('can:RestoreInvoice');
    Route::delete('/{id}/force_delete', 'force_delete')->name('force_delete')->middleware('can:ForceDeleteInvoice');
	Route::get('/{invoice}/print', 'print')->name('print')->middleware('can:PrintInvoice');
	Route::post('/{invoice}/getDetail', 'getDetail')->name('getDetail');
});