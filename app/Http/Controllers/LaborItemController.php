<?php

namespace App\Http\Controllers;

use App\Models\LaborItem;
use App\Models\LaborType;
use Illuminate\Http\Request;
use App\Http\Requests\LaborItemRequest;

class LaborItemController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index()
	{
		$data['rows'] = LaborItem::where('labor_items.status', 1)
			->select(['labor_items.*', 'labor_types.name_en as type_en'])
			->leftJoin('labor_types', 'labor_types.id', '=', 'labor_items.type')
			->orderBy('labor_items.index', 'asc')
			->get();
		return view('labor_item.index', $data);
	}

	/**
	 * Show the form for creating a new resource.
	 */
	public function create()
	{
		$data['type'] = LaborType::where('id', request()->type)
								->where('status', 1)
								->orderBy('index', 'asc')
								->first();
		return view('labor_item.create', $data);
	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function store(LaborItemRequest $request)
	{
		if (LaborItem::create([
			'name_en' => $request->name,
			'name_kh' => $request->name,
			'min_range' => $request->min_range,
			'max_range' => $request->max_range,
			'unit' => $request->unit,
			'type' => $request->type,
			'index' => $request->index ?: 999,
			'other' => $request->other,
			'status' => 1,
		])) {
			return redirect()->route('setting.labor-type.index', ['type' => $request->type, 'old' => $request->old])->with('success', 'Data created success');
		}
	}

	/**
	 * Show the form for editing the specified resource.
	 */
	public function edit(LaborItem $laborItem)
	{
		$data['row'] = $laborItem;
		return view('labor_item.edit', $data);
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(LaborItemRequest $request, LaborItem $laborItem)
	{
		if ($laborItem->update([
			'name_en' => $request->name,
			'name_kh' => $request->name,
			'min_range' => $request->min_range,
			'max_range' => $request->max_range,
			'unit' => $request->unit,
			'index' => $request->index ?: 999,
			'other' => $request->other,
		])) {
			return redirect()->route('setting.labor-item.edit', ['laborItem' => $laborItem->id, 'type' => $request->type, 'old' => $request->old])->with('success', 'Data update success');
		}
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(Request $request, LaborItem $laborItem)
	{
		if ($laborItem->update(['status' => 0])) {
			return redirect()->route('setting.labor-type.index', $request->only(['type', 'old']))->with('success', 'Data delete success');
		}
	}

	public function sort_order()
	{
		$data['rows'] = LaborItem::with(['hasType'])->where('status', 1)->orderBy('index', 'asc')->get();
		return view('labor_item.order', $data);
	}

	public function update_order(Request $request)
	{
		if (is_array($request->ids) && count($request->ids) > 0) {
			$laborItems = LaborItem::where('status', 1)->whereIn('id', $request->ids)->orderBy('index', 'asc')->get();
			foreach ($request->ids as $index => $id) {
				$laborItems->where('id', $id)->first()->update(['index' => ++$index]);
			}
		}
		return back()->with('success', 'Data sort successful');
	}
}
