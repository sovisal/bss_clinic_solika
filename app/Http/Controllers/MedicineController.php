<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inventory\Product;
use App\Http\Requests\MedicineRequest;
use Yajra\DataTables\Facades\DataTables;

class MedicineController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Product::withCount('stockins');

            return DataTables::of($data)
                ->addColumn('dt', function ($r) {
                    return [
                        'code' => $r->code,
                        'name' => d_obj($r, ['name_kh', 'name_en']),
                        'cost' => d_currency($r->cost),
                        'price' => d_currency($r->price),
                        'status' => d_status($r->status),
                        'action' => d_action([
                            'moduleAbility' => 'Medicine', 'module' => 'setting.medicine', 'id' => $r->id, 'isTrashed' => $r->trashed(),
                            'showBtnShow' => false,
                            'disableDelete' => false,
                        ]),
                    ];
                })
                ->rawColumns(['dt.status', 'dt.code', 'dt.action'])
                ->make(true);
        } else {
            return view('medicine.index');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = ['is_edit' => false];
        return view('medicine.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MedicineRequest $request)
    {
        if (Product::create([
            // 'code' => generate_code('PR', 'products'),
            'name_en' => $request->name_en,
            'name_kh' => $request->name_kh,
            'unit_id' => 1,
            'cost' => $request->cost ?? 0,
            'price' => $request->price ?? 0,
            'qty_remain' => 100,
        ])) {

            return redirect()->route('setting.medicine.index')->with('success', __('alert.message.success.crud.create'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $medicine)
    {
        $data = [
            'row' => $medicine,
            'is_edit' => true,
        ];
        return view('medicine.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MedicineRequest $request, Product $medicine)
    {
        if ($medicine->update([
            'name_en' => $request->name_en,
            'name_kh' => $request->name_kh,
            'cost' => $request->cost ?? 0,
            'price' => $request->price ?? 0,
        ])) {

            return redirect()->route('setting.medicine.index')->with('success', __('alert.message.success.crud.update'));
        }
    }

    /**
     * Remove the specified resource to trash.
     */
    public function destroy(Product $medicine)
    {
        if ($medicine->delete()) {
            return redirect()->route('setting.medicine.index')->with('success', __('alert.message.success.crud.delete'));
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
