<?php

namespace App\Http\Controllers;

use App\Models\Inventory\StockOut;
use App\Http\Requests\StockOutRequest;

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
        return view('stock_out.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StockOutRequest $request)
    {
        
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
}
