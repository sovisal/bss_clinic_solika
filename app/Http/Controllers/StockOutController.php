<?php

namespace App\Http\Controllers;

use App\Models\Inventory\Product;
use App\Models\Inventory\StockIn;
use App\Models\Inventory\StockOut;
use App\Models\Inventory\ProductUnit;
use App\Http\Requests\StockOutRequest;
use App\Models\Inventory\ProductPackage;
use Illuminate\Support\Facades\Validator;

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
        $result = $this->createStockOut($request);
        if ($result->success) {
            return redirect()->route('inventory.stock_out.index')->with('success', ($result->errors ? '' : 'Data created success'))->with('errors', $result->errors);
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
        $result = collect();
        $result->errors = [];
        $validator = Validator::make([],[]);
        if (count($request->date) > 0) {
            // Get all related Packages
            $packages = ProductPackage::whereIn('product_id', $request->product_id)->whereIn('product_unit_id', $request->unit_id)->get();
            foreach ($request->date as $index => $value) {
                // Get specific Package for each product
                $package = $packages->where('product_id', $request->product_id[$index])->where('product_unit_id', $request->unit_id[$index])->first();
                // Calculate Total Qty for stock remain
                $total_qty_out = $request->qty[$index] * ($package->qty ?? 1);
                $stock_in_ids = [];
                // Get all StockIn available
                $stock_ins = StockIn::where('remain', '>', 0)->where('product_id', $request->product_id[$index])->orderBy('exp_date', 'asc')->orderBy('date', 'asc')->get();
                if ($stock_ins->sum('remain') >= $total_qty_out) {
                    foreach ($stock_ins as $stock_in) {
                        $stock_in_ids[] = $stock_in->id;
                        if ($stock_in->remain >= $total_qty_out) {
                            $stock_in->update([
                                'remain' => $stock_in->remain - $total_qty_out
                            ]);
                            break;
                        } else {
                            $total_qty_out -= $stock_in->remain;
                            $stock_in->update([
                                'remain' => 0
                            ]);
                        }
                    }
                    // Create new Stock in row in database
                    StockOut::create([
                        'date' => $request->date[$index] ?? date('Y-m-d'),
                        'document_no' => $request->reciept_no[$index] ?? '',
                        'price' => $request->price[$index] ?? 0,
                        'qty' => $request->qty[$index] ?? 0,
                        'product_id' => $request->product_id[$index] ?? null,
                        'unit_id' => $request->unit_id[$index] ?? null,
                        'stock_in_id' => implode(',', $stock_in_ids),
                        'type' => $request->type,
                    ]);
                } else {
                    $product = Product::find($request->product_id[$index]);
                    $validator->errors()->add('stock_out', 'Insufficient stock on product: ' . d_obj($product, ['name_kh', 'name_en']) . '! total requested stock is ' . d_number($total_qty_out) . ' but total stock available is ' . d_number($stock_ins->sum('remain')));
                }
            }
            $result->errors = $validator->errors();
            $result->success = true;
            return $result;
        }
        $result->success = false;
        return $result;
    }
}
