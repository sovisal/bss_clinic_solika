<?php

namespace App\Http\Controllers;

use App\Models\EcgType;
use Illuminate\Http\Request;
use App\Http\Requests\EcgTypeRequest;

class EcgTypeController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['rows'] = EcgType::with('user')
            ->where('status', 1)
            ->filterTrashed()
            ->orderBy('index', 'asc')
            ->get();
        return view('ecg_type.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['index'] = EcgType::getNextIndex();
        return view('ecg_type.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EcgTypeRequest $request)
    {
        // serialize all post into string
        $serialize = array_except($request->all(), ['_method', '_token']);
        $request['attribite'] = serialize($serialize);
        if (EcgType::create([
            'name_en' => $request->name_en,
            'name_kh' => $request->name_kh,
            'price' => $request->price ?: 0,
            'attribite' => $request->attribite,
            'index' => $request->index ?: 999,
            'default_form' => $request->default_form,
        ])) {
            return redirect()->route('setting.ecg-type.index')->with('success', 'Data created success');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(EcgType $ecgType)
    {
        append_array_to_obj($ecgType, unserialize($ecgType->attribite) ?: []);
        $data['row'] = $ecgType;
        return view('ecg_type.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EcgTypeRequest $request, EcgType $ecgType)
    {
        // serialize all post into string
        $serialize = array_except($request->all(), ['_method', '_token']);
        $request['attribite'] = serialize($serialize);

        if ($ecgType->update([
            'name_en' => $request->name_en,
            'name_kh' => $request->name_kh,
            'price' => $request->price ?: 0,
            'attribite' => $request->attribite,
            'index' => $request->index ?: 999,
            'default_form' => $request->default_form,
        ])) {
            return redirect()->route('setting.ecg-type.index')->with('success', 'Data update success');
        }
    }

    public function sort_order()
    {
        $data['rows'] = EcgType::where('status', 1)->orderBy('index', 'asc')->get();
        $data['url'] = route('setting.ecg-type.update_order');
        $data['back_url'] = route('setting.ecg-type.index');
        return view('shared.setting_service.order', $data);
    }

    public function update_order(Request $request)
    {
        EcgType::saveOrder($request);
        return back()->with('success', 'Data sort successful');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(EcgType $ecgType)
    {
        if ($ecgType->delete()) {
            return redirect()->route('setting.ecg-type.index')->with('success', __('alert.message.success.crud.delete'));
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function restore($id)
    {
        $ecgType = EcgType::onlyTrashed()->findOrFail($id);
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
        $ecgType = EcgType::onlyTrashed()->findOrFail($id);
        if ($ecgType->forceDelete()) {
            return back()->with('success', __('alert.message.success.crud.force_detele'));
        }
        return back()->with('error', __('alert.message.error.crud.force_detele'));
    }
}
