<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\ProductTypeController;
use App\Http\Controllers\ProductUnitController;
use App\Http\Controllers\ProductPackageController;
use App\Http\Controllers\ProductCategoryController;

Route::middleware(['auth'])->name('inventory.')->group(function () {
    Route::prefix('product')->name('product.')->controller(ProductController::class)->group(function () {
        Route::get('/', 'index')->name('index')->middleware('can:ViewAnyProduct');
        Route::get('/create', 'create')->name('create')->middleware('can:CreateProduct');
        Route::post('/store', 'store')->name('store')->middleware('can:CreateProduct');
        Route::get('/{product}/edit', 'edit')->name('edit')->middleware('can:UpdateProduct');
        Route::put('/{product}/update', 'update')->name('update')->middleware('can:UpdateProduct');
        Route::delete('/{product}/delete', 'destroy')->name('delete')->middleware('can:DeleteProduct');
        Route::put('/{product}/restore', 'restore')->name('restore')->middleware('can:RestoreProduct');
        Route::delete('/{product}/force_delete', 'force_delete')->name('force_delete')->middleware('can:ForceDeleteProduct');
        // Route::post('/getDetail', 'getDetail')->name('getDetail');
        Route::post('/getUnit', 'getUnit')->name('getUnit');
    });

    Route::prefix('product_category')->name('product_category.')->controller(ProductCategoryController::class)->group(function () {
        Route::get('/', 'index')->name('index')->middleware('can:ViewAnyProductCategory');
        Route::get('/create', 'create')->name('create')->middleware('can:CreateProductCategory');
        Route::post('/store', 'store')->name('store')->middleware('can:CreateProductCategory');
        Route::get('/{productCategory}/edit', 'edit')->name('edit')->middleware('can:UpdateProductCategory');
        Route::put('/{productCategory}/update', 'update')->name('update')->middleware('can:UpdateProductCategory');
        Route::delete('/{productCategory}/delete', 'destroy')->name('delete')->middleware('can:DeleteProductCategory');
        Route::put('/{productCategory}/restore', 'restore')->name('restore')->middleware('can:RestoreProductCategory');
        Route::delete('/{productCategory}/force_delete', 'force_delete')->name('force_delete')->middleware('can:ForceDeleteProductCategory');
    });

    Route::prefix('product_type')->name('product_type.')->controller(ProductTypeController::class)->group(function () {
        Route::get('/', 'index')->name('index')->middleware('can:ViewAnyProductType');
        Route::get('/create', 'create')->name('create')->middleware('can:CreateProductType');
        Route::post('/store', 'store')->name('store')->middleware('can:CreateProductType');
        Route::get('/{productType}/edit', 'edit')->name('edit')->middleware('can:UpdateProductType');
        Route::put('/{productType}/update', 'update')->name('update')->middleware('can:UpdateProductType');
        Route::delete('/{productType}/delete', 'destroy')->name('delete')->middleware('can:DeleteProductType');
        Route::put('/{productType}/restore', 'restore')->name('restore')->middleware('can:RestoreProductType');
        Route::delete('/{productType}/force_delete', 'force_delete')->name('force_delete')->middleware('can:ForceDeleteProductType');
    });

    Route::prefix('product_package')->name('product_package.')->controller(ProductPackageController::class)->group(function () {
        Route::get('/', 'index')->name('index')->middleware('can:ViewAnyProductPackage');
        Route::get('/create', 'create')->name('create')->middleware('can:CreateProductPackage');
        Route::post('/store', 'store')->name('store')->middleware('can:CreateProductPackage');
        Route::get('/{productPackage}/edit', 'edit')->name('edit')->middleware('can:UpdateProductPackage');
        Route::put('/{productPackage}/update', 'update')->name('update')->middleware('can:UpdateProductPackage');
        Route::delete('/{productPackage}/delete', 'destroy')->name('delete')->middleware('can:DeleteProductPackage');
        Route::put('/{productPackage}/restore', 'restore')->name('restore')->middleware('can:RestoreProductPackage');
        Route::delete('/{productPackage}/force_delete', 'force_delete')->name('force_delete')->middleware('can:ForceDeleteProductPackage');
    });

    Route::prefix('product_unit')->name('product_unit.')->controller(ProductUnitController::class)->group(function () {
        Route::get('/', 'index')->name('index')->middleware('can:ViewAnyProductUnit');
        Route::get('/create', 'create')->name('create')->middleware('can:CreateProductUnit');
        Route::post('/store', 'store')->name('store')->middleware('can:CreateProductUnit');
        Route::get('/{productUnit}/edit', 'edit')->name('edit')->middleware('can:UpdateProductUnit');
        Route::put('/{productUnit}/update', 'update')->name('update')->middleware('can:UpdateProductUnit');
        Route::delete('/{productUnit}/delete', 'destroy')->name('delete')->middleware('can:DeleteProductUnit');
        Route::put('/{productUnit}/restore', 'restore')->name('restore')->middleware('can:RestoreProductUnit');
        Route::delete('/{productUnit}/force_delete', 'force_delete')->name('force_delete')->middleware('can:ForceDeleteProductUnit');
    });

    Route::prefix('supplier')->name('supplier.')->controller(SupplierController::class)->group(function () {
        Route::get('/', 'index')->name('index')->middleware('can:ViewAnySupplier');
        Route::get('/create', 'create')->name('create')->middleware('can:CreateSupplier');
        Route::post('/store', 'store')->name('store')->middleware('can:CreateSupplier');
        Route::get('/{supplier}/edit', 'edit')->name('edit')->middleware('can:UpdateSupplier');
        Route::put('/{supplier}/update', 'update')->name('update')->middleware('can:UpdateSupplier');
        Route::delete('/{supplier}/delete', 'destroy')->name('delete')->middleware('can:DeleteSupplier');
        Route::put('/{supplier}/restore', 'restore')->name('restore')->middleware('can:RestoreSupplier');
        Route::delete('/{supplier}/force_delete', 'force_delete')->name('force_delete')->middleware('can:ForceDeleteSupplier');
        Route::post('/getDetail', 'getDetail')->name('getDetail');
        Route::post('/getProduct', 'getProduct')->name('getProduct');
    });

});
