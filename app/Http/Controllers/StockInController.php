<?php

namespace App\Http\Controllers;

use App\Models\Inventory\Product;
use App\Models\Inventory\StockIn;
use App\Models\Inventory\Supplier;
use App\Http\Requests\StockInRequest;
use App\Models\Inventory\ProductUnit;
use App\Models\Inventory\ProductPackage;

class StockInController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'rows' => StockIn::with(['user', 'unit', 'supplier', 'product.unit'])->withCount('stock_outs')->filterTrashed()->orderBy('date', 'desc')->limit(5000)->get(),
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
        $allProducts = Product::whereIn('id', $request->input('product_id', []))->get();

        foreach ($request->input('product_id', []) as $index => $value) {
            if ($product = $allProducts->where('id', $request->product_id[$index])->first()) {
                $stockIn = StockIn::create([
                    'type' => 'StockIn',
                    'date' => $request->date[$index] ?? date('Y-m-d'),
                    'exp_date' => $request->exp_date[$index] ?? null,
                    'reciept_no' => $request->reciept_no[$index] ?? '',
                    'price' => $request->price[$index] ?? 0,
                    'qty' => $request->qty[$index] ?? 0,
                    'qty_remain' => $request->qty_based[$index] ?? 0,
                    'qty_based' => $request->qty_based[$index] ?? 0,
                    'qty_remain' => $request->qty_based[$index] ?? 0,
                    'total' => $request->total[$index] ?? 0,
                    'supplier_id' => $request->supplier_id[$index] ?? null,
                    'product_id' => $request->product_id[$index] ?? null,
                    'unit_id' => $request->unit_id[$index] ?? null,
                ]);
                $product->qty_in += $stockIn->qty_based;
                $product->qty_remain += $stockIn->qty_remain;
                $product->save();

                $stockIn->product()->first()->updateQtyRamain();
            }
        }
        return redirect()->route('inventory.stock_in.index')->with('success', 'Data created success');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(StockIn $stockIn)
    {
        $data = [
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
            'total' => ($stockIn->qty * $request->price),
        ])) {
            $stockIn->product()->first()->updateQtyRamain();
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
