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
            return $this->expired($request);
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

    public function expired($request)
    {
        if ($request->ajax()) {
            $data = StockIn::with(['user', 'unit', 'supplier', 'product.unit'])
            ->expired();

            return Datatables::of($data)
            ->addColumn('dt', function ($r) {
                return [
                    'date' => d_date($r->date, 'Y-m-d'),
                    'code' => d_obj($r, 'product', 'code'),
                    'product' => d_obj($r, 'product', 'link'),
                    'supplier' => d_obj($r, 'supplier', 'link'),
                    'qty' => d_number($r->qty),
                    'unit' => d_obj($r, 'unit', 'link'),
                    'qty_based' => d_number($r->qty_based),
                    'p_unit' => d_obj($r, 'product', 'unit', 'link'),
                    'qty_used' => d_number($r->qty_used),
                    'qty_remain' => d_number($r->qty_remain),
                    'exp_date' => d_date($r->exp_date, 'Y-m-d'),
                    'status' => $r->exp_date > date('Y-m-d') ? '--' : d_status(false, 'Expired'),
                ];
            })
            ->rawColumns(['dt.status', 'dt.product', 'dt.supplier', 'dt.unit', 'dt.p_unit', 'dt.exp_status', 'dt.status', 'dt.action'])
            ->make(true);
        } else {
            return view('stock_alert.index_expired');
        }
    }
}
