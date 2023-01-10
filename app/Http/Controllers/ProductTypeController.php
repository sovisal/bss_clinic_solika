<?php

namespace App\Http\Controllers;

use App\Models\Inventory\ProductType;
use App\Http\Requests\ProductTypeRequest;
use Illuminate\Http\Request;
use DataTables;

class ProductTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = ProductType::with(['user'])->withCount('products')->withCount('suppliers');

            return Datatables::of($data)
                ->addColumn('dt', function ($r) {
                    return [
                        'name' => d_obj($r, ['name_kh', 'name_en']),
                        'description' => d_text($r->description),
                        'products_count' => d_badge($r->products_count),
                        'suppliers_count' => d_badge($r->suppliers_count),
                        'user' => d_obj($r, 'user', 'name'),
                        'status' => d_status($r->status),
                        'action' => d_action([
                            'moduleAbility' => 'ProductType', 'module' => 'inventory.product_type', 'id' => $r->id, 'isTrashed' => $r->trashed(),
                            'disableEdit' => $r->trashed(), 'showBtnShow' => false,
                            'disableDelete' => $r->id == 1 || $r->products_count > 0 || $r->suppliers_count > 0,
                        ]),
                    ];
                })
                ->rawColumns(['dt.status', 'dt.products_count', 'dt.action', 'dt.suppliers_count'])
                ->make(true);
        } else {
            return view('product_type.index');
        }
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
            'description' => $request->description,
        ])) {
            return redirect()->route('inventory.product_type.index')->with('success', __('alert.message.success.crud.create'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProductType $productType)
    {
        return view('product_type.edit', ['row' => $productType]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductTypeRequest $request, ProductType $productType)
    {
        if ($productType->update([
            'name_en' => $request->name_en,
            'name_kh' => $request->name_kh,
            'description' => $request->description,
        ])) {
            return redirect()->route('inventory.product_type.index')->with('success', __('alert.message.success.crud.update'));
        }
    }

    /**
     * Remove the specified resource to trash.
     */
    public function destroy(ProductType $productType)
    {
        if ($productType->delete()) {
            return redirect()->route('inventory.product_type.index')->with('success', __('alert.message.success.crud.delete'));
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
