<?php

namespace App\Http\Controllers;

use App\Models\Inventory\ProductCategory;
use App\Http\Requests\ProductCategoryRequest;
use Illuminate\Http\Request;
use DataTables;

class ProductCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = ProductCategory::with(['user'])->withCount('products')->withCount('suppliers');

            return Datatables::of($data)
                ->addColumn('dt', function ($r) {
                    return [
                        'name' => d_obj($r, ['name_kh', 'name_en']),
                        'description' => d_text($r->description ? substr($r->description, 0, 75) . ' ...' : ''),
                        'products_count' => d_badge($r->products_count),
                        'suppliers_count' => d_badge($r->suppliers_count),
                        'user' => d_obj($r, 'user', 'name'),
                        'status' => d_status($r->status),
                        'action' => d_action([
                            'module-ability'=> 'ProductCategory', 'module' => 'inventory.product_category', 'id' => $r->id, 'isTrashed' => $r->trashed(),
                            'disableEdit' => $r->trashed(), 'showBtnShow' => false,
                            'disableDelete' => $r->products_count > 0 || $r->suppliers_count > 0,
                        ]),
                    ];
                })
                ->rawColumns(['dt.status', 'dt.products_count', 'dt.action', 'dt.suppliers_count'])
                ->make(true);
        } else {
            return view('product_category.index');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('product_category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductCategoryRequest $request)
    {
        if (ProductCategory::create([
            'name_en' => $request->name_en,
            'name_kh' => $request->name_kh,
            // 'total_product' => $request->total_product,
            'description' => $request->description,
        ])) {
            return redirect()->route('inventory.product_category.index')->with('success', __('alert.message.success.crud.create'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProductCategory $productCategory)
    {
        return view('product_category.edit', [ 'row' => $productCategory ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductCategoryRequest $request, ProductCategory $productCategory)
    {
        if ($productCategory->update([
            'name_en' => $request->name_en,
            'name_kh' => $request->name_kh,
            // 'total_product' => $request->total_product,
            'description' => $request->description,
        ])) {
            return redirect()->route('inventory.product_category.index')->with('success', __('alert.message.success.crud.update'));
        }
    }

    /**
     * Remove the specified resource to trash.
     */
    public function destroy(ProductCategory $productCategory)
    {
        if ($productCategory->delete()) {
            return redirect()->route('inventory.product_category.index')->with('success', __('alert.message.success.crud.delete'));
        }
    }

    /**
     * Restore the specified resource from storage.
     */
    public function restore($id)
    {
        $row = ProductCategory::onlyTrashed()->findOrFail($id);
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
        $row = ProductCategory::onlyTrashed()->findOrFail($id);
        if ($row->forceDelete()) {
            return back()->with('success', __('alert.message.success.crud.force_detele'));
        }
        return back()->with('error', __('alert.message.error.crud.force_detele'));
    }
}
