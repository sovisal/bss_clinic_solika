<?php

namespace App\Http\Controllers;

use App\Models\Inventory\ProductCategory;
use App\Http\Requests\ProductCategoryRequest;

class ProductCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'rows' => ProductCategory::with(['products', 'user'])->filterTrashed()->orderBy('name_en')->limit(5000)->get(),
        ];
        return view('product_category.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('product_category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductCategoryRequest $request)
    {
        if (ProductCategory::create([
            'name_en' => $request->name_en,
            'name_kh' => $request->name_kh,
            // 'total_product' => $request->total_product,
            'description' => $request->description,
        ])) {
            return redirect()->route('inventory.product_category.index')->with('success', 'Data created success');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProductCategory $productCategory)
    {
        return view('product_category.edit', [ 'row' => $productCategory ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductCategoryRequest $request, ProductCategory $productCategory)
    {
        if ($productCategory->update([
            'name_en' => $request->name_en,
            'name_kh' => $request->name_kh,
            // 'total_product' => $request->total_product,
            'description' => $request->description,
        ])) {
            return redirect()->route('inventory.product_category.index')->with('success', 'Data created success');
        }
    }

    /**
     * Remove the specified resource to trash.
     */
    public function destroy(ProductCategory $productCategory)
    {
        if ($productCategory->delete()) {
            return redirect()->route('inventory.product_category.index')->with('success', 'Data delete success');
        }
    }

    /**
     * Restore the specified resource from storage.
     */
    public function restore($id)
    {
        $row = ProductCategory::onlyTrashed()->findOrFail($id);
        if ($row->restore()) {
            return back()->with('success', __('alert.message.success.crud.restore'));
        }
        return back()->with('error', __('alert.message.error.crud.restore'));
    }

    /**
     * Force Delete the specified resource from storage.
     */
    public function force_delete($id)
    {
        $row = ProductCategory::onlyTrashed()->findOrFail($id);
        if ($row->forceDelete()) {
            return back()->with('success', __('alert.message.success.crud.force_detele'));
        }
        return back()->with('error', __('alert.message.error.crud.force_detele'));
    }
}
