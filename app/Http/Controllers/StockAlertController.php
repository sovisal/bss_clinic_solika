<?php

namespace App\Http\Controllers;

use App\Models\Inventory\Product;
use App\Models\Inventory\StockIn;
use Illuminate\Http\Request;

class StockAlertController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index(Request $request)
    {
        if ($request->expired) {
            return $this->expired();
        } else {
            return $this->out_of_stock();
        }
    }

    public function out_of_stock()
    {
        $data = [
            'rows' => Product::with(['unit', 'type', 'category'])
                ->OutOfStock()
                ->orderBy('name_en')
                ->limit(5000)
                ->get(),
        ];

        return view('stock_alert.index_out_of_stock', $data);
    }

    public function expired()
    {
        $data['rows'] = StockIn::with(['user', 'unit', 'supplier', 'product.unit'])
            ->expired()
            ->limit(5000)
            ->get();

        return view('stock_alert.index_expired', $data);
    }
}
