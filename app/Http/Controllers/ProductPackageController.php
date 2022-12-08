<?php

namespace App\Http\Controllers;

use App\Models\Inventory\ProductPackage;
use App\Http\Requests\StoreProductPackageRequest;
use App\Http\Requests\UpdateProductPackageRequest;

class ProductPackageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProductPackageRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductPackageRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Inventory\ProductPackage  $productPackage
     * @return \Illuminate\Http\Response
     */
    public function show(ProductPackage $productPackage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Inventory\ProductPackage  $productPackage
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductPackage $productPackage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProductPackageRequest  $request
     * @param  \App\Models\Inventory\ProductPackage  $productPackage
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductPackageRequest $request, ProductPackage $productPackage)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Inventory\ProductPackage  $productPackage
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductPackage $productPackage)
    {
        //
    }
}
