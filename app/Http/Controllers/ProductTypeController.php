<?php

namespace App\Http\Controllers;

use App\Models\Inventory\ProductType;
use App\Http\Requests\ProductTypeRequest;

class ProductTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'rows' => ProductType::with(['user'])->withCount('products')->filterTrashed()->orderBy('name_en')->limit(5000)->get(),
        ];
        return view('product_type.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('product_type.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductTypeRequest $request)
    {
        if (ProductType::create([
            'name_en' => $request->name_en,
            'name_kh' => $request->name_kh,
            // 'total_product' => $request->total_product,
            'description' => $request->description,
        ])) {
            return redirect()->route('inventory.product_type.index')->with('success', 'Data created success');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProductType $productType)
    {
        return view('product_type.edit', [ 'row' => $productType ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductTypeRequest $request, ProductType $productType)
    {
        if ($productType->update([
            'name_en' => $request->name_en,
            'name_kh' => $request->name_kh,
            // 'total_product' => $request->total_product,
            'description' => $request->description,
        ])) {
            return redirect()->route('inventory.product_type.index')->with('success', 'Data created success');
        }
    }

    /**
     * Remove the specified resource to trash.
     */
    public function destroy(ProductType $productType)
    {
        if ($productType->delete()) {
            return redirect()->route('inventory.product_type.index')->with('success', 'Data delete success');
        }
    }

    /**
     * Restore the specified resource from storage.
     */
    public function restore($id)
    {
        $row = ProductType::onlyTrashed()->findOrFail($id);
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
        $row = ProductType::onlyTrashed()->findOrFail($id);
        if ($row->forceDelete()) {
            return back()->with('success', __('alert.message.success.crud.force_detele'));
        }
        return back()->with('error', __('alert.message.error.crud.force_detele'));
    }
}
