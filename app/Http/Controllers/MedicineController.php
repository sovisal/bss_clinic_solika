<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inventory\Product;
use Illuminate\Support\Facades\File;
use App\Http\Requests\ProductRequest;
use App\Models\Inventory\ProductUnit;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\ProductUpdateRequest;

class MedicineController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Product::with(['user', 'unit', 'type', 'category'])->withCount('stockins');

            return DataTables::of($data)
                ->addColumn('dt', function ($r) {
                    return [
                        'code' => $r->code,
                        'name' => d_obj($r, ['name_kh', 'name_en']),
                        'cost' => d_currency($r->cost),
                        'price' => d_currency($r->price),
                        'unit' => d_obj($r, 'unit', 'link'),
                        'type' => d_obj($r, 'type', 'link'),
                        'category' => d_obj($r, 'category', 'link'),
                        'qty_alert' => d_number($r->qty_alert),
                        'qty_remain' => ('<span style="color: ' . (d_number($r->qty_remain) == 0 ? 'red' : 'green') . '">' . d_number($r->qty_remain) . '</span>'),
                        'user' => d_obj($r, 'user', 'name'),
                        'status' => $r->qty_remain == 0 ? d_status(false, 'Out of Stock') : ($r->qty_remain > 0 && $r->qty_remain <= $r->qty_alert ? d_status(false, 'Almost Out of Stock', '', 'badge-warning') : d_status(true)),

                        'action' => d_action([
                            'module-ability'=> 'Product', 'module' => 'inventory.product', 'id' => $r->id, 'isTrashed' => $r->trashed(),
                            'showBtnShow' => false,
                            'disableDelete' => $r->stockins_count > 0 || $r->qty_in > 0 || $r->qty_out > 0 || $r->qty_remain > 0,
                        ]),
                    ];
                })
                ->rawColumns(['dt.status', 'dt.code', 'dt.unit', 'dt.type', 'dt.category', 'dt.qty_remain', 'dt.user', 'dt.action'])
                ->make(true);
        } else {
            return view('product.index');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            'units' => ProductUnit::where('status', 1)->orderBy('name_en', 'asc')->get(),
            'code' => generate_code('PR', 'products', false),
            'is_edit' => false,
        ];
        return view('product.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
        if ($product = Product::create([
            'code' => $request->code,
            'name_en' => $request->name_en,
            'name_kh' => $request->name_kh,
            'unit_id' => $request->unit_id,
            'type_id' => $request->type_id,
            'category_id' => $request->category_id,
            
            'cost' => $request->cost ?? 0,
            'price' => $request->price ?? 0,
            'qty_begin' => $request->qty_begin ?: 0,
            'qty_alert' => $request->qty_alert ?: 0,
            'qty_in' => $request->qty_begin ?: 0,
            'qty_remain' => $request->qty_begin ?: 0,
        ])) {
            $this->update_package($request, $product);
            $this->update_begin_balance($product);

            if ($request->code == generate_code('PR', 'products', false)) {
                generate_code('PR', 'products');
            }
            // Check if no exist folder/directory then create folder/directory
            $path = public_path('/images/products/');
            File::makeDirectory($path, 0777, true, true);
            $image =  create_image($request->image, $path, (time() . '_image_' . rand(111, 999) . '.png'));
            $product->update(['image' => $image]);

            return redirect()->route('inventory.product.index')->with('success', __('alert.message.success.crud.create'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $data = [
            'row' => $product,
            'units' => ProductUnit::where('status', 1)->orderBy('name_en', 'asc')->get(),
            'is_edit' => true,
        ];
        return view('product.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductUpdateRequest $request, Product $product)
    {
        // Check if no exist folder/directory then create folder/directory
        $path = public_path('/images/products/');
        File::makeDirectory($path, 0777, true, true);
        $image = update_image($request->image, $path, (time() . '_image_' . rand(111, 999) . '.png'), $product->image);
        if ($product->update(array_merge(
            ['image' => $image],
            [
                'code' => $request->code,
                'name_en' => $request->name_en,
                'name_kh' => $request->name_kh,
                'cost' => $request->cost ?? 0,
                'price' => $request->price ?? 0,
                'unit_id' => $request->unit_id ?: $product->unit_id,
                'type_id' => $request->type_id,
                'category_id' => $request->category_id,
                'qty_alert' => $request->qty_alert,
            ]
        ))) {
            $this->update_package($request, $product);

            return redirect()->route('inventory.product.index')->with('success', __('alert.message.success.crud.update'));
        }
    }

    /**
     * Remove the specified resource to trash.
     */
    public function destroy(Product $product)
    {
        if ($product->delete()) {
            return redirect()->route('inventory.product.index')->with('success', __('alert.message.success.crud.delete'));
        }
    }

    /**
     * Restore the specified resource from storage.
     */
    public function restore($id)
    {
        $row = Product::onlyTrashed()->findOrFail($id);
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
        $row = Product::onlyTrashed()->findOrFail($id);
        if ($row->forceDelete()) {
            return back()->with('success', __('alert.message.success.crud.force_detele'));
        }
        return back()->with('error', __('alert.message.error.crud.force_detele'));
    }
}
