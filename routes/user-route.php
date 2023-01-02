<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AbilityController;


Route::name('user.')->middleware(['auth'])->group(function () {

	Route::prefix('user')->controller(UserController::class)->group(function () {
		Route::get('/', 'index')->name('index')->middleware('can:ViewAnyUser');
		Route::get('/create', 'create')->name('create')->middleware('can:CreateUser');
		Route::post('/store', 'store')->name('store')->middleware('can:CreateUser');
		Route::get('/{user}/edit', 'edit')->name('edit')->middleware('can:UpdateUser');
		Route::put('/{user}/update', 'update')->name('update')->middleware('can:UpdateUser');
		Route::delete('/{user}/delete', 'destroy')->name('delete')->middleware('can:DeleteUser');
		Route::put('/{user}/restore', 'restore')->name('restore')->middleware('can:RestoreUser');
		Route::get('/{user}/role', 'role')->name('role')->middleware('can:AssignUserRole');
		Route::put('/{user}/assign_role', 'assign_role')->name('assign_role')->middleware('can:AssignUserRole');
		Route::get('/{user}/ability', 'ability')->name('ability')->middleware('can:AssignUserAbility');
		Route::put('/{user}/assign_ability', 'assign_ability')->name('assign_ability')->middleware('can:AssignUserAbility');
		Route::get('/{user}/password', 'password')->name('password')->middleware('can:UpdateUserPassword');
		Route::put('/{user}/update_password', 'update_password')->name('update_password')->middleware('can:UpdateUserPassword');
		Route::get('/{type}/account', 'account')->name('account');
		Route::put('/{type}/update_account', 'update_account')->name('update_account');
	});

	Route::prefix('ability')->name('ability.')->controller(AbilityController::class)->group(function () {
		Route::get('/', 'index')->name('index')->middleware('can:ViewAnyAbility');
		Route::get('/create', 'create')->name('create')->middleware('can:CreateAbility');
		Route::post('/store', 'store')->name('store')->middleware('can:CreateAbility');
		Route::get('/{ability_module}/edit', 'edit')->name('edit')->middleware('can:UpdateAbility');
		Route::put('/{ability_module}/update', 'update')->name('update')->middleware('can:UpdateAbility');
		Route::delete('/{ability_module}/delete', 'destroy')->name('delete')->middleware('can:DeleteAbility');
		Route::post('/show', 'show')->name('show')->middleware('can:ViewAnyAbility');
	});

	Route::prefix('role')->name('role.')->controller(RoleController::class)->group(function () {
		Route::get('/', 'index')->name('index')->middleware('can:ViewAnyRole');
		Route::get('/create', 'create')->name('create')->middleware('can:CreateRole');
		Route::post('/store', 'store')->name('store')->middleware('can:CreateRole');
		Route::get('/{role}/edit', 'edit')->name('edit')->middleware('can:UpdateRole');
		Route::put('/{role}/update', 'update')->name('update')->middleware('can:UpdateRole');
		Route::delete('/{role}/delete', 'destroy')->name('delete')->middleware('can:DeleteRole');
		Route::get('/{role}/ability', 'ability')->name('ability')->middleware('can:AssignRoleAbility');
		Route::put('/{role}/assign_ability', 'assign_ability')->name('assign_ability')->middleware('can:AssignRoleAbility');
	});
});