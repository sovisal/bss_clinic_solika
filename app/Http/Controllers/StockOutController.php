<?php

namespace App\Http\Controllers;

use App\Models\Inventory\Product;
use App\Models\Inventory\StockIn;
use App\Models\Inventory\StockOut;
use App\Http\Requests\StockOutRequest;
use App\Models\Inventory\ProductPackage;

class StockOutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'rows' => StockOut::with(['user'])->filterTrashed()->orderBy('date')->limit(5000)->get(),
        ];
        return view('stock_out.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            'products' => Product::where('status', 1)->orderBy('name_en', 'asc')->get(),
        ];
        return view('stock_out.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StockOutRequest $request)
    {
        dd($request->all());
        if ($this->createStockOut($request)) {
            return redirect()->route('inventory.stock_in.index')->with('success', 'Data created success');
        }
        return back()->with('error', 'Not data was created');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(StockOut $stockOut)
    {
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StockOutRequest $request, StockOut $stockOut)
    {
        
    }

    /**
     * Remove the specified resource to trash.
     */
    public function destroy(StockOut $stockOut)
    {
        if ($stockOut->delete()) {
            return redirect()->route('inventory.stock_out.index')->with('success', 'Data delete success');
        }
    }

    /**
     * Restore the specified resource from storage.
     */
    public function restore($id)
    {
        $row = StockOut::onlyTrashed()->findOrFail($id);
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
        $row = StockOut::onlyTrashed()->findOrFail($id);
        if ($row->forceDelete()) {
            return back()->with('success', __('alert.message.success.crud.force_detele'));
        }
        return back()->with('error', __('alert.message.error.crud.force_detele'));
    }

    public function createStockOut($request)
    {
        if (count($request->date) > 0) {
            // Get all related Packages
            $packages = ProductPackage::whereIn('product_id', $request->product_id)->whereIn('product_unit_id', $request->unit_id)->get();
            foreach ($request->date as $index => $value) {
                // Get specific Package for each product
                $package = $packages->where('product_id', $request->product_id[$index])->where('product_unit_id', $request->unit_id[$index])->first();
                // Calculate Total Qty for stock remain
                $total_qty = $request->qty[$index] * ($package->qty ?? 0);
                $stock_in_ids = [];

                $stock_ins = StockIn::where('remain', '>', 0)->get()->pluck('id');

                // Create new Stock in row in database
                StockOut::create([
                    'date' => $request->date[$index] ?? date('Y-m-d'),
                    'reciept_no' => $request->reciept_no[$index] ?? '',
                    'price' => $request->price[$index] ?? 0,
                    'qty' => $request->qty[$index] ?? 0,
                    'product_id' => $request->product_id[$index] ?? null,
                    'unit_id' => $request->unit_id[$index] ?? null,
                    'stock_in_id' => $stock_in_ids,
                    'type' => $request->type,
                ]);
            }
            return true;
        }
        return false;
    }
}
