<?php

namespace App\Http\Controllers;

use App\Models\Inventory\Product;
use Illuminate\Support\Facades\File;
use App\Http\Requests\ProductRequest;
use App\Models\Inventory\ProductUnit;
use App\Models\Inventory\ProductCategory;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'rows' => Product::with(['user'])->filterTrashed()->orderBy('name_en')->limit(5000)->get(),
        ];
        return view('product.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            'units' => ProductUnit::where('status', 1)->orderBy('name_en', 'asc')->get(),
            'categories' => ProductCategory::where('status', 1)->orderBy('name_en', 'asc')->get(),
        ];
        return view('product.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
        if ($product = Product::create([
            // 'code' => $request->code,
            'code' => generate_code('PR', 'products'),
            'name_en' => $request->name_en,
            'name_kh' => $request->name_kh,
            'cost' => $request->cost,
            'price' => $request->price,
            'unit_id' => $request->unit_id,
            'category_id' => $request->category_id,
        ])) {

            // Check if no exist folder/directory then create folder/directory
            $path = public_path('/images/products/');
            File::makeDirectory($path, 0777, true, true);
            $image =  create_image($request->image, $path, (time() . '_image_' . rand(111, 999) . '.png'));
            $product->update(['image' => $image]);

            return redirect()->route('inventory.product.index')->with('success', 'Data created success');
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
            'categories' => ProductCategory::where('status', 1)->orderBy('name_en', 'asc')->get(),
        ];
        return view('product.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, Product $product)
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
                'cost' => $request->cost,
                'price' => $request->price,
                'unit_id' => $request->unit_id,
                'category_id' => $request->category_id,
            ]
        ))) {

            return redirect()->route('inventory.product.index')->with('success', 'Data created success');
        }
    }

    /**
     * Remove the specified resource to trash.
     */
    public function destroy(Product $product)
    {
        if ($product->delete()) {
            return redirect()->route('inventory.product.index')->with('success', 'Data delete success');
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
