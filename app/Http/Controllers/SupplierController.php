<?php

namespace App\Http\Controllers;

use App\Models\Inventory\Supplier;
use Illuminate\Support\Facades\File;
use App\Http\Requests\SupplierRequest;
use App\Http\Requests\StoreSupplierRequest;
use App\Http\Requests\UpdateSupplierRequest;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'rows' => Supplier::with(['user'])->filterTrashed()->orderBy('name_en')->limit(5000)->get(),
        ];
        return view('supplier.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            
        ];
        return view('supplier.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SupplierRequest $request)
    {
        if ($supplier = Supplier::create([
            // 'code' => $request->code,
            'code' => generate_code('PR', 'suppliers'),
            'name_en' => $request->name_en,
            'name_kh' => $request->name_kh,
            'cost' => $request->cost,
            'price' => $request->price,
            'unit_id' => $request->unit_id,
            'category_id' => $request->category_id,
        ])) {

            // Check if no exist folder/directory then create folder/directory
            $path = public_path('/images/suppliers/');
            File::makeDirectory($path, 0777, true, true);
            $logo =  create_image($request->logo, $path, (time() . '_logo_' . rand(111, 999) . '.png'));
            $supplier->update(['logo' => $logo]);

            return redirect()->route('inventory.supplier.index')->with('success', 'Data created success');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Supplier $supplier)
    {
        $data = [
            'row' => $supplier,
        ];
        return view('supplier.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SupplierRequest $request, Supplier $supplier)
    {
        // Check if no exist folder/directory then create folder/directory
        $path = public_path('/images/suppliers/');
        File::makeDirectory($path, 0777, true, true);
        $logo = update_image($request->logo, $path, (time() . '_logo_' . rand(111, 999) . '.png'), $supplier->logo);
        if ($supplier->update(array_merge(
            ['logo' => $logo],
            [
                'code' => $request->code,
                'name_en' => $request->name_en,
                'name_kh' => $request->name_kh,
                'cost' => $request->cost,
                'price' => $request->price,
                'unit_id' => $request->unit_id,
                'category_id' => $request->category_id,
            ]
        ))) {

            return redirect()->route('inventory.supplier.index')->with('success', 'Data created success');
        }
    }

    /**
     * Remove the specified resource to trash.
     */
    public function destroy(Supplier $supplier)
    {
        if ($supplier->delete()) {
            return redirect()->route('inventory.supplier.index')->with('success', 'Data delete success');
        }
    }

    /**
     * Restore the specified resource from storage.
     */
    public function restore($id)
    {
        $row = Supplier::onlyTrashed()->findOrFail($id);
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
        $row = Supplier::onlyTrashed()->findOrFail($id);
        if ($row->forceDelete()) {
            return back()->with('success', __('alert.message.success.crud.force_detele'));
        }
        return back()->with('error', __('alert.message.error.crud.force_detele'));
    }
}
