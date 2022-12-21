<?php

namespace App\Http\Controllers;

use App\Models\Inventory\Product;
use App\Http\Requests\ProductRequest;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource to trash.
     */
    public function destroy(Product $product)
    {
        //
    }

    /**
     * Restore the specified resource from storage.
     */
    public function restore($id)
    {
        //
    }

    /**
     * Force Delete the specified resource from storage.
     */
    public function force_delete($id)
    {
        //
    }
}
