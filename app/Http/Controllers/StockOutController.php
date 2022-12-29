<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inventory\Product;
use App\Models\Inventory\StockOut;
use App\Http\Requests\StockOutRequest;
use Illuminate\Support\Facades\Validator;

class StockOutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'rows' => StockOut::with(['product.unit', 'unit', 'user'])->filterTrashed()->orderBy('date')->limit(5000)->get(),
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
        $validator = Validator::make([],[]);
        $allProducts = Product::with([
            'stockins' => function ($q) { $q->where('qty_remain', '>', 0)->orderBy('date'); }
        ])->whereIn('id', $request->input('product_id', []))->get();

        foreach ($request->input('product_id', []) as $index => $value) {
            if ($product = $allProducts->where('id', $request->product_id[$index] ?? '')->first()) {
                if ($product->stockins->sum('qty_remain') >= $request->qty_based[$index]) {
                    $req = (object)[
                            'type' => 'StockOut',
                            'date' => $request->date[$index],
                            'document_no' => $request->reciept_no[$index],
                            'product_id' => $request->product_id[$index],
                            'unit_id' => $request->unit_id[$index],
                            'price' => $request->price[$index],
                            'qty_based' => $request->qty_based[$index],
                            'qty' => $request->qty[$index],
                            'note' => $request->note[$index],
                            'total' => $request->total[$index],
                        ];
                    $this->createStockOut($product, $req);
                }else{
                    // If requested stock is larger then stock available add error for msg
                    $validator->errors()->add($index, 'Insufficient stock on product: ' . d_obj($product, ['name_kh', 'name_en']) . '! total requested stock is ' . d_number($request->qty_based[$index]) . ' but total stock available is ' . d_number($product->stockins->sum('qty_remain')));
                }
            }
        }

        return redirect()->route('inventory.stock_out.index')->with('success', ($validator->errors() ? '' : __('alert.message.success.crud.create')))->with('errors', $validator->errors());
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(StockOut $stockOut)
    {
        $data = [
            'row' => $stockOut
        ];
        return view('stock_out.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StockOutRequest $request, StockOut $stockOut)
    {
        if ($this->updateStockOut($stockOut, $request)) {
            return redirect()->route('inventory.stock_out.index')->with('success', __('alert.message.success.crud.update'));
        }
    }

    public function updateStockOut($stockOut, $request)
    {
        return $stockOut->update([
            'date' => $request->date,
            'document_no' => $request->reciept_no,
            'price' => $request->price,
            'total' => ($stockOut->qty * $request->price),
        ]);
    }

    /**
     * Remove the specified resource to trash.
     */
    public function destroy(StockOut $stockOut)
    {
        $product =  $stockOut->product;
        if ($this->deleteStockOut($stockOut)) {
            $product->updateQty();
            return redirect()->route('inventory.stock_out.index')->with('success', __('alert.message.success.crud.delete'));
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

    public function createStockOut($product, $request)
    {
        $requested_qty = $request->qty_based;
        $stockOutCreated = StockOut::create([
            'type' => $request->type,
            'date' => $request->date,
            'document_no' => $request->document_no,
            'product_id' => $request->product_id,
            'unit_id' => $request->unit_id,
            'price' => $request->price,
            'qty_based' => $request->qty_based,
            'qty' => $request->qty,
            'note' => $request->note,
            'total' => $request->total
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
        $product->updateQty();

        return true;
    }

    public function deleteStockOut($stockOut)
    {
        foreach ($stockOut->stock_ins as $stockIn) {
            $stockIn->update([
                'qty_used' => $stockIn->qty_used - ($stockIn->pivot->qty ?? 0),
                'qty_remain' => $stockIn->qty_remain + ($stockIn->pivot->qty ?? 0),
            ]);
        }
        $stockOut->stock_ins()->sync([]);

        return $stockOut->delete();
    }
}
