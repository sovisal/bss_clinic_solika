<?php

namespace App\Http\Controllers;

use App\Models\Inventory\Product;
use App\Models\Inventory\StockIn;
use Illuminate\Http\Request;
use DataTables;

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
            return $this->out_of_stock($request);
        }
    }

    public function out_of_stock($request)
    {
        if ($request->ajax()) {
            $data = Product::with(['unit', 'type', 'category'])->OutOfStock()->orderBy('qty_remain', 'asc');
            return Datatables::of($data)
                ->addColumn('dt', function ($r) {
                    return [
                        'code' => $r->code,
                        'link' => $r->link,
                        'unit' => d_obj($r, 'unit', 'link'),
                        'type' => d_obj($r, 'type', 'link'),
                        'category' => d_obj($r, 'category', 'link'),
                        'qty_alert' => $r->qty_alert,
                        'qty_remain' => ('<span style="color: ' . (d_number($r->qty_remain) == 0 ? 'red' : 'green') . '">' . d_number($r->qty_remain) . '</span>'),
                        'status' => $r->qty_remain == 0 ? d_status(false, 'Out of Stock') : ($r->qty_remain > 0 && $r->qty_remain <= $r->qty_alert ? d_status(false, 'Almost Out of Stock', '', 'badge-warning') : d_status(true)),
                    ];
                })
                ->rawColumns(['dt.status', 'dt.code', 'dt.link', 'dt.unit', 'dt.type', 'dt.category', 'dt.qty_remain', 'dt.qty_in', 'dt.qty_out'])
                ->make(true);
        } else {
            return view('stock_alert.index_out_of_stock');
        }
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
