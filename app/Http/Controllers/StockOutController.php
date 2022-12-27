<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
        return redirect()->route('inventory.stock_out.index')->with('success', ($result->errors ? '' : 'Data created success'))->with('errors', $result->errors);
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
        $allProducts = Product::with([
            'stockins' => function ($q) use ($request) {
                $q->where('qty_remain', '>', 0)
                ->orderBy('date');
            }
        ])->whereIn('id', $request->input('product_id', []))->get();

        $result = collect();
        $result->errors = [];
        $validator = Validator::make([],[]);
        foreach ($request->input('product_id', []) as $index => $value) {
            if ($product = $allProducts->where('id', $request->product_id[$index] ?? '')->first()) {
                if ($product->stockins->sum('qty_remain') >= $request->qty_based[$index]) {
                    $requested_qty = $request->qty_based[$index];
                    $stockOutCreated = StockOut::create([
                        'type' => 'StockOut',
                        'date' => $request->date[$index],
                        'document_no' => $request->reciept_no[$index],
                        'product_id' => $request->product_id[$index],
                        'unit_id' => $request->unit_id[$index],
                        'price' => $request->price[$index],
                        'qty' => $requested_qty,
                        'total' => $request->total[$index]
                    ]);
                    $stockIns = $product->stockins->where('qty_remain', '>', 0);
                    foreach ($stockIns as $key => $stockIn) {
                        if ($stockIn->qty_remain >= $requested_qty) {
                            $qty_used = $stockIn->qty_used + $requested_qty;
                            $qty_remain = $stockIn->qty_based - $qty_used;
                            $stockOutCreated->stock_ins()->attach([$stockIn->id => ['qty' => $requested_qty]]);
                            $stockIn->update([
                                'qty_used' => $qty_used,
                                'qty_remain' => $qty_remain,
                            ]);
                            $requested_qty = 0;
                            break;
                        }else{
                            $requested_qty -= $stockIn->qty_remain;
                            $qty_used = $stockIn->qty_used + $stockIn->qty_remain; // OR $qty_used = $stockIn->qty_based;
                            $qty_remain = $stockIn->qty_based - $qty_used; // OR $qty_remain = 0;
                            $stockOutCreated->stock_ins()->attach([$stockIn->id => ['qty' => $stockIn->qty_remain]]);
                            $stockIn->update([
                                'qty_used' => $qty_used,
                                'qty_remain' => $qty_remain,
                            ]);
                        }
                    }
                    $product->qty_out += $request->qty_based[$index];
                    $product->qty_remain -= $request->qty_based[$index];
                    $product->save();
                }else{
                    // If requested stock is larger then stock available add error for msg
                    $validator->errors()->add($index, 'Insufficient stock on product: ' . d_obj($product, ['name_kh', 'name_en']) . '! total requested stock is ' . d_number($request->qty_based[$index]) . ' but total stock available is ' . d_number($product->stockins->sum('qty_remain')));
                }
            }
        }
        $result->errors = $validator->errors();
        return $result;
    }
}
