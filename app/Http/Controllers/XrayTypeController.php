<?php

namespace App\Http\Controllers;

use App\Models\XrayType;
use App\Http\Requests\StoreXrayTypeRequest;
use App\Http\Requests\UpdateXrayTypeRequest;
use Illuminate\Http\Request;

class XrayTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->data['rows'] = XrayType::with(['user'])
            ->where('status', 1)
            ->filterTrashed()
            ->orderBy('index', 'asc')
            ->get();
        return view('xray_type.index', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['index'] = XrayType::getNextIndex();
        return view('xray_type.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // serialize all post into string
        $serialize = array_except($request->all(), ['_method', '_token']);
        $request['attribite'] = serialize($serialize);
        if (XrayType::create([
            'name_en' => $request->name_en,
            'name_kh' => $request->name_kh,
            'price' => $request->price ?: 0,
            'attribite' => $request->attribite,
            'index' => $request->index ?: 999,
            'default_form' => $request->default_form,
        ])) {
            return redirect()->route('setting.xray-type.index')->with('success', 'Data created success');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(XrayType $xrayType)
    {
        append_array_to_obj($xrayType, unserialize($xrayType->attribite) ?: []);
        $data['row'] = $xrayType;
        return view('xray_type.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, XrayType $xrayType)
    {
        // serialize all post into string
        $serialize = array_except($request->all(), ['_method', '_token']);
        $request['attribite'] = serialize($serialize);

        if ($xrayType->update([
            'name_en' => $request->name_en,
            'name_kh' => $request->name_kh,
            'price' => $request->price ?: 0,
            'attribite' => $request->attribite,
            'index' => $request->index ?: 999,
            'default_form' => $request->default_form,
        ])) {
            return redirect()->route('setting.xray-type.index')->with('success', 'Data update success');
        }
    }

    public function sort_order()
    {
        $data['rows'] = XrayType::where('status', 1)->orderBy('index', 'asc')->get();
        $data['url'] = route('setting.xray-type.update_order');
        return view('shared.setting_service.order', $data);
    }

    public function update_order(Request $request)
    {
        XrayType::saveOrder($request);
        return back()->with('success', 'Data sort successful');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(XrayType $xrayType)
    {
        if ($xrayType->delete()) {
            return redirect()->route('setting.xray-type.index')->with('success', 'Data delete success');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function restore($id)
    {
        $ecgType = XrayType::onlyTrashed()->findOrFail($id);
        if ($ecgType->restore()) {
            return back()->with('success', __('alert.message.success.crud.restore'));
        }
        return back()->with('error', __('alert.message.error.crud.restore'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function force_delete($id)
    {
        $ecgType = XrayType::onlyTrashed()->findOrFail($id);
        if ($ecgType->forceDelete()) {
            return back()->with('success', __('alert.message.success.crud.force_detele'));
        }
        return back()->with('error', __('alert.message.error.crud.force_detele'));
    }
}
