<?php

namespace App\Http\Controllers;

use App\Models\Inventory\Supplier;
use Illuminate\Support\Facades\File;
use App\Models\Inventory\ProductType;
use App\Http\Requests\SupplierRequest;
use App\Models\Inventory\ProductCategory;
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
            'categories' => ProductCategory::where('status', 1)->orderBy('name_en', 'asc')->get(),
            'types' => ProductType::where('status', 1)->orderBy('name_en', 'asc')->get(),
        ];
        return view('supplier.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SupplierRequest $request)
    {
        $address_id = update4LevelAddress($request);
        if ($supplier = Supplier::create([
            'name_en' => $request->name_en,
            'name_kh' => $request->name_kh,
            'contact_name' => $request->contact_name,
            'contact_number' => $request->contact_number,
            'description' => $request->description,
            'payment_info' => $request->payment_info,
            'other' => $request->other,
            'type_id' => $request->type_id,
            'category_id' => $request->category_id,
            'address_id' => $address_id
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
            'categories' => ProductCategory::where('status', 1)->orderBy('name_en', 'asc')->get(),
            'types' => ProductType::where('status', 1)->orderBy('name_en', 'asc')->get(),
        ];
        return view('supplier.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SupplierRequest $request, Supplier $supplier)
    {
        $address_id = update4LevelAddress($request, $supplier->address_id);
        // Check if no exist folder/directory then create folder/directory
        $path = public_path('/images/suppliers/');
        File::makeDirectory($path, 0777, true, true);
        $logo = update_image($request->logo, $path, (time() . '_logo_' . rand(111, 999) . '.png'), $supplier->logo);
        if ($supplier->update(array_merge(
            ['logo' => $logo],
            [
                'name_en' => $request->name_en,
                'name_kh' => $request->name_kh,
                'contact_name' => $request->contact_name,
                'contact_number' => $request->contact_number,
                'description' => $request->description,
                'payment_info' => $request->payment_info,
                'other' => $request->other,
                'type_id' => $request->type_id,
                'category_id' => $request->category_id,
                'address_id' => $address_id
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
