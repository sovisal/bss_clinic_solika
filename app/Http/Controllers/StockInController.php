<?php

namespace App\Http\Controllers;

use App\Models\Inventory\Product;
use App\Models\Inventory\StockIn;
use App\Models\Inventory\Supplier;
use App\Http\Requests\StockInRequest;
use App\Models\Inventory\ProductUnit;

class StockInController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'rows' => StockIn::with(['user'])->filterTrashed()->orderBy('date')->limit(5000)->get(),
        ];
        return view('stock_in.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            'suppliers' => Supplier::where('status', 1)->orderBy('name_en', 'asc')->get(),
        ];
        return view('stock_in.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StockInRequest $request)
    {
        dd($request->all());
        if (StockIn::create([
            'date' => $request->date,
            'exp_date' => $request->exp_date,
            'reciept_no' => $request->reciept_no,
            'price' => $request->price,
            'qty' => $request->qty,
            'supplier_id' => $request->supplier_id,
            'product_id' => $request->product_id,
            'unit_id' => $request->unit_id
        ])) {
            return redirect()->route('inventory.stock_in.index')->with('success', 'Data created success');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(StockIn $stockIn)
    {
        $data = [
            'suppliers' => Supplier::where('status', 1)->orderBy('name_en', 'asc')->get(),
            'row' => $stockIn
        ];
        return view('stock_in.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StockInRequest $request, StockIn $stockIn)
    {
        if ($stockIn->update([
            'date' => $request->date,
            'exp_date' => $request->exp_date,
            'reciept_no' => $request->reciept_no,
            'price' => $request->price,
            'qty' => $request->qty,
            'supplier_id' => $request->supplier_id,
            'product_id' => $request->product_id,
            'unit_id' => $request->unit_id
        ])) {
            return redirect()->route('inventory.stock_in.index')->with('success', 'Data created success');
        }
    }

    /**
     * Remove the specified resource to trash.
     */
    public function destroy(StockIn $stockIn)
    {
        if ($stockIn->delete()) {
            return redirect()->route('inventory.stock_in.index')->with('success', 'Data delete success');
        }
    }

    /**
     * Restore the specified resource from storage.
     */
    public function restore($id)
    {
        $row = StockIn::onlyTrashed()->findOrFail($id);
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
        $row = StockIn::onlyTrashed()->findOrFail($id);
        if ($row->forceDelete()) {
            return back()->with('success', __('alert.message.success.crud.force_detele'));
        }
        return back()->with('error', __('alert.message.error.crud.force_detele'));
    }
}
