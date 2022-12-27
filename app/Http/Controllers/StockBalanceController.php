<?php

namespace App\Http\Controllers;

use App\Models\Inventory\Product;

class StockBalanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'rows' => Product::with(['unit', 'type', 'category'])->filterTrashed()->orderBy('name_en')->limit(5000)->get(),
        ];
        return view('stock_balance.index', $data);
    }
}
