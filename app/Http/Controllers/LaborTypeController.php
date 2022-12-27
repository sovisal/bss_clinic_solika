<?php

namespace App\Http\Controllers;

use App\Models\LaborType;
use App\Http\Requests\LaborTypeRequest;
use Illuminate\Http\Request;

class LaborTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $laborTypes = LaborType::with('user')
            ->where('labor_types.status', 1)
            ->with('parent')
            ->orderBy('labor_types.index', 'asc')
            ->filterTrashed()
            ->get();
        $data['rows'] = $laborTypes;
        return view('labor_type.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['index'] = LaborType::getNextIndex();
        $data['parents'] = LaborType::select(['id', 'name_en', 'name_kh'])
            ->where('parent_id', null)
            ->orderBy('index', 'asc')->get()
            ->map(function ($parent) {
                $parent->rendered_name = d_obj($parent, ['name_en', 'name_kh']);
                return $parent;
            })
            ->pluck('rendered_name', 'id');
        return view('labor_type.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(LaborTypeRequest $request)
    {
        LaborType::create([
            'name_kh' => $request->name_kh,
            'name_en' => $request->name_en,
            'index' => $request->index,
            'parent_id' => $request->parent_id,
        ]);
        return redirect(route('setting.labor-type.index'))->with('success', __('alert.message.success.crud.create'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LaborType $laborType)
    {
        $data['row'] = $laborType;
        $data['parents'] = LaborType::select(['id', 'name_en', 'name_kh'])
            ->where('parent_id', null)
            ->where('id', '!=', $laborType->id)
            ->orderBy('index', 'asc')->get()
            ->map(function ($parent) {
                $parent->rendered_name = d_obj($parent, ['name_en', 'name_kh']);
                return $parent;
            })
            ->pluck('rendered_name', 'id');
        return view('labor_type.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(LaborTypeRequest $request, LaborType $laborType)
    {
        $laborType->update([
            'name_kh' => $request->name_kh,
            'name_en' => $request->name_en,
            'index' => $request->index,
            'parent_id' => $request->parent_id,
        ]);
        return redirect(route('setting.labor-type.index'))->with('success', __('alert.message.success.crud.update'));
    }

    public function sort_order()
    {
        $data['rows'] = LaborType::where('status', 1)->orderBy('index', 'asc')->get();
        $data['url'] = route('setting.labor-type.update_order');
        $data['back_url'] = route('setting.labor-type.index');
        return view('shared.setting_service.order', $data);
    }

    public function update_order(Request $request)
    {
        LaborType::saveOrder($request);
        return redirect(route('setting.labor-type.index'))->with('success', __('alert.message.success.sort'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LaborType $laborType)
    {
        if ($laborType->delete()) {
            return redirect(route('setting.labor-type.index'))->with('success', 'Data delete success');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function restore($id)
    {
        $laborType = LaborType::onlyTrashed()->findOrFail($id);
        if ($laborType->restore()) {
            return back()->with('success', __('alert.message.success.crud.restore'));
        }
        return back()->with('error', __('alert.message.error.crud.restore'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function force_delete($id)
    {
        $laborType = LaborType::onlyTrashed()->findOrFail($id);
        if ($laborType->forceDelete()) {
            return back()->with('success', __('alert.message.success.crud.force_detele'));
        }
        return back()->with('error', __('alert.message.error.crud.force_detele'));
    }
}
