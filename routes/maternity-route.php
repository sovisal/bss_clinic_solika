<?php

use Illuminate\Support\Facades\Route;


Route::middleware(['auth'])->prefix('maternity')->name('maternity.')->group(function () {
    Route::controller(MaternityController::class)->group(function () {
        Route::get('/', 'index')->name('index')->middleware('can:ViewAnyMaternity');
        Route::get('/create', 'create')->name('create')->middleware('can:CreateMaternity');
        Route::post('/store', 'store')->name('store')->middleware('can:CreateMaternity');
        Route::get('/{maternity}/edit', 'edit')->name('edit')->middleware('can:UpdateMaternity');
        Route::put('/{maternity}/update', 'update')->name('update')->middleware('can:UpdateMaternity');
        Route::delete('/{maternity}/delete', 'destroy')->name('delete')->middleware('can:DeleteMaternity');
        Route::put('/{maternity}/restore', 'restore')->name('restore')->middleware('can:RestoreMaternity');
        Route::delete('/{maternity}/force_delete', 'force_delete')->name('force_delete')->middleware('can:ForceDeleteMaternity');
        Route::get('/{maternity}/show', 'show')->name('show')->middleware('can:ViewAnyMaternity');
        Route::post('/getSelect2', 'getSelect2')->name('getSelect2');
        Route::post('/getSelectDetail', 'getSelectDetail')->name('getSelectDetail');
    });

    Route::prefix('consultation')->name('consultation.')->controller(ConsultationController::class)->group(function () {
        Route::get('/', 'index')->name('consultation.index')->middleware('can:ViewAnyConsultation');
        Route::get('/create', 'create')->name('consultation.create')->middleware('can:CreateConsultation');
        Route::post('/store', 'store')->name('consultation.store')->middleware('can:CreateConsultation');
        Route::get('/{consultation}/edit', 'edit')->name('consultation.edit')->middleware('can:CreateConsultation');
        Route::put('/{consultation}/update', 'update')->name('consultation.update')->middleware('can:CreateConsultation');
        Route::post('/getTemplate', 'getTemplate')->name('consultation.getTemplate');
        Route::get('/get_indication/{category_id}', function ($category_id) {
            return json_encode(getParentDataSelection('indication_disease', ['status' => 1, 'parent_id' => $category_id]));
        })->name('consultation.get_indication');
        Route::get('/treament_plan_label/{patient_id}', 'getTreamentPlanLinkLabel');
    });
});
