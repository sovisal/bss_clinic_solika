<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inventory\ProductUnit;
use App\Http\Requests\ProductUnitRequest;

class ProductUnitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'rows' => ProductUnit::with(['user'])->withCount('products')->filterTrashed()->orderBy('name_en')->limit(5000)->get(),
        ];
        return view('product_unit.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('product_unit.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductUnitRequest $request)
    {
        if (ProductUnit::create([
            'name_en' => $request->name_en,
            'name_kh' => $request->name_kh,
            'description' => $request->description,
        ])) {
            return redirect()->route('inventory.product_unit.index')->with('success', 'Data created success');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProductUnit $productUnit)
    {
        return view('product_unit.edit', [ 'row' => $productUnit ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductUnitRequest $request, ProductUnit $productUnit)
    {
        if ($productUnit->update([
            'name_en' => $request->name_en,
            'name_kh' => $request->name_kh,
            'description' => $request->description,
        ])) {
            return redirect()->route('inventory.product_unit.index')->with('success', 'Data created success');
        }
    }

    /**
     * Remove the specified resource to trash.
     */
    public function destroy(ProductUnit $productUnit)
    {
        if ($productUnit->delete()) {
            return redirect()->route('inventory.product_unit.index')->with('success', 'Data delete success');
        }
    }

    /**
     * Restore the specified resource from storage.
     */
    public function restore($id)
    {
        $row = ProductUnit::onlyTrashed()->findOrFail($id);
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
        $row = ProductUnit::onlyTrashed()->findOrFail($id);
        if ($row->forceDelete()) {
            return back()->with('success', __('alert.message.success.crud.force_detele'));
        }
        return back()->with('error', __('alert.message.error.crud.force_detele'));
    }

    // public function getPackage(Request $request)
    // {
    //     # code...
    // }
}
