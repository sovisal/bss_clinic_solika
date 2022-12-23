<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StockAdjustment;
use App\Models\Inventory\Product;
use App\Http\Requests\StockAdjustmentRequest;

class StockAdjustmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'rows' => StockAdjustment::with(['user'])->filterTrashed()->orderBy('date')->limit(5000)->get(),
        ];
        return view('stock_adjustment.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            'products' => Product::where('status', 1)->orderBy('name_en', 'asc')->get(),
        ];
        return view('stock_adjustment.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StockAdjustmentRequest $request)
    {
        if (StockAdjustment::create([
            'date' => $request->date,
            'exp_date' => $request->exp_date,
            'reciept_no' => $request->reciept_no,
            'price' => $request->price,
            'qty' => $request->qty,
            'supplier_id' => $request->supplier_id,
            'product_id' => $request->product_id,
            'unit_id' => $request->unit_id
        ])) {
            return redirect()->route('inventory.stock_adjustment.index')->with('success', 'Data created success');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(StockAdjustment $stockAdjustment)
    {
        $data = [
            'products' => Product::where('status', 1)->orderBy('name_en', 'asc')->get(),
            'row' => $stockAdjustment
        ];
        return view('stock_adjustment.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StockAdjustmentRequest $request, StockAdjustment $stockAdjustment)
    {
        if ($stockAdjustment->update([
            'date' => $request->date,
            'exp_date' => $request->exp_date,
            'reciept_no' => $request->reciept_no,
            'price' => $request->price,
            'qty' => $request->qty,
            'supplier_id' => $request->supplier_id,
            'product_id' => $request->product_id,
            'unit_id' => $request->unit_id
        ])) {
            return redirect()->route('inventory.stock_adjustment.index')->with('success', 'Data created success');
        }
    }

    /**
     * Remove the specified resource to trash.
     */
    public function destroy(StockAdjustment $stockAdjustment)
    {
        if ($stockAdjustment->delete()) {
            return redirect()->route('inventory.stock_adjustment.index')->with('success', 'Data delete success');
        }
    }

    /**
     * Restore the specified resource from storage.
     */
    public function restore($id)
    {
        $row = StockAdjustment::onlyTrashed()->findOrFail($id);
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
        $row = StockAdjustment::onlyTrashed()->findOrFail($id);
        if ($row->forceDelete()) {
            return back()->with('success', __('alert.message.success.crud.force_detele'));
        }
        return back()->with('error', __('alert.message.error.crud.force_detele'));
    }
}
