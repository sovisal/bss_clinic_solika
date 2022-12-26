<?php

namespace App\Http\Controllers;

use App\Models\Inventory\StockOutDetail;
use App\Http\Requests\StoreStockOutDetailRequest;
use App\Http\Requests\UpdateStockOutDetailRequest;

class StockOutDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreStockOutDetailRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreStockOutDetailRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Inventory\StockOutDetail  $stockOutDetail
     * @return \Illuminate\Http\Response
     */
    public function show(StockOutDetail $stockOutDetail)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Inventory\StockOutDetail  $stockOutDetail
     * @return \Illuminate\Http\Response
     */
    public function edit(StockOutDetail $stockOutDetail)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateStockOutDetailRequest  $request
     * @param  \App\Models\Inventory\StockOutDetail  $stockOutDetail
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateStockOutDetailRequest $request, StockOutDetail $stockOutDetail)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Inventory\StockOutDetail  $stockOutDetail
     * @return \Illuminate\Http\Response
     */
    public function destroy(StockOutDetail $stockOutDetail)
    {
        //
    }
}
