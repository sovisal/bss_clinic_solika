<?php

namespace App\Http\Controllers;

use App\Models\LaborItem;
use App\Models\LaborType;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Requests\LaborItemRequest;

class LaborItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(LaborType $laborType)
    {
        $laborType->load([
            'items' => function ($q) {
                $q->filterTrashed();
            }
        ]);
        $data['rows'] = $laborType->items;
        $data['laborType'] = $laborType;
        return view('labor_item.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(LaborType $laborType)
    {
        $data['laborType'] = $laborType;
        $data['index'] = Str::after(LaborItem::getNextIndex(['type_id' => $laborType->id]), '.') + 1;
        return view('labor_item.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(LaborType $laborType, LaborItemRequest $request)
    {
        if (LaborItem::create([
            'name_en' => $request->name_en,
            'name_kh' => $request->name_kh,
            'min_range' => $request->min_range,
            'max_range' => $request->max_range,
            'unit' => $request->unit,
            'type_id' => $laborType->id,
            'index' => $laborType->index . '.' . $request->index ?: 999,
            'other' => $request->other,
            'user_id' => auth()->user()->id,
        ])) {
            return redirect()->route('setting.labor-item.index', $laborType->id)->with('success', __('alert.message.success.crud.create'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LaborType $laborType, LaborItem $laborItem)
    {
        $data['row'] = $laborItem;
        $data['laborType'] = $laborType;
        return view('labor_item.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(LaborItemRequest $request, LaborType $laborType, LaborItem $laborItem)
    {
        if ($laborItem->update([
            'name_en' => $request->name_en,
            'name_kh' => $request->name_kh,
            'min_range' => $request->min_range,
            'max_range' => $request->max_range,
            'unit' => $request->unit,
            'index' => $laborType->index . '.' . $request->index ?: 999,
            'other' => $request->other,
        ])) {
            return redirect()->route('setting.labor-item.index', $laborType->id)->with('success', __('alert.message.success.crud.update'));
        }
    }

    public function sort_order(LaborType $laborType)
    {
        $data['rows'] = $laborType->items->where('status', 1);
        $data['url'] = route('setting.labor-item.update_order', $laborType->id);
        $data['back_url'] = route('setting.labor-item.index', $laborType->id);
        return view('shared.setting_service.order', $data);
    }

    public function update_order(LaborType $laborType, Request $request)
    {
        if (is_array($request->ids) && count($request->ids) > 0) {
            $rows = $laborType->items->where('status', 1)->whereIn('id', $request->ids);
            foreach ($request->ids as $index => $id) {
                $rows->where('id', $id)->first()->update(['index' => $laborType->index . '.' . ++$index]);
            }
        }
        return redirect(route('setting.labor-item.index', $laborType->id))->with('success', __('alert.message.success.sort'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LaborType $laborType, LaborItem $laborItem)
    {
        if ($laborItem->delete()) {
            return redirect()->route('setting.labor-item.index', $laborType->id)->with('success', __('alert.message.success.crud.delete'));
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function restore($id)
    {
        $laborItem = LaborItem::onlyTrashed()->findOrFail($id);
        if ($laborItem->restore()) {
            return back()->with('success', __('alert.message.success.crud.restore'));
        }
        return back()->with('error', __('alert.message.error.crud.restore'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function force_delete($id)
    {
        $laborItem = LaborItem::onlyTrashed()->findOrFail($id);
        if ($laborItem->forceDelete()) {
            return back()->with('success', __('alert.message.success.crud.force_detele'));
        }
        return back()->with('error', __('alert.message.error.crud.force_detele'));
    }
}
