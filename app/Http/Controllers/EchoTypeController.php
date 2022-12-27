<?php

namespace App\Http\Controllers;

use App\Models\EchoType;
use Illuminate\Http\Request;
use App\Http\Requests\EchoTypeRequest;

class EchoTypeController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->data['rows'] = EchoType::with(['user'])->where('status', 1)
            ->filterTrashed()
            ->orderBy('index', 'asc')
            ->get();
        return view('echo_type.index', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['index'] = EchoType::getNextIndex();
        return view('echo_type.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EchoTypeRequest $request)
    {
        // serialize all post into string
        $serialize = array_except($request->all(), ['_method', '_token']);
        $request['attribite'] = serialize($serialize);

        $dataParent = new EchoType();
        if ($dataParent->create([
            'name_en' => $request->name_en,
            'name_kh' => $request->name_kh,
            'price' => $request->price ?: 0,
            'attribite' => $request->attribite,
            'index' => $request->index ?: 999,
            'default_form' => $request->default_form,
        ])) {
            return redirect()->route('setting.echo-type.index')->with('success', __('alert.message.success.crud.create'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(EchoType $echoType)
    {
        append_array_to_obj($echoType, unserialize($echoType->attribite) ?: []);
        $data['row'] = $echoType;
        return view('echo_type.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EchoTypeRequest $request, EchoType $echoType)
    {
        // serialize all post into string
        $serialize = array_except($request->all(), ['_method', '_token']);
        $request['attribite'] = serialize($serialize);

        if ($echoType->update($request->all())) {
            return redirect()->route('setting.echo-type.index')->with('success', __('alert.message.success.crud.update'));
        }
    }

    public function sort_order()
    {
        $data['rows'] = EchoType::where('status', 1)->orderBy('index', 'asc')->get();
        $data['url'] = route('setting.echo-type.update_order');
        $data['back_url'] = route('setting.echo-type.index');
        return view('shared.setting_service.order', $data);
    }

    public function update_order(Request $request)
    {
        EchoType::saveOrder($request);
        return redirect(route('setting.echo-type.index'))->with('success', __('alert.message.success.sort'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(EchoType $echoType)
    {
        if ($echoType->delete()) {
            return redirect()->route('setting.echo-type.index')->with('success', __('alert.message.success.crud.delete'));
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function restore($id)
    {
        $echoType = EchoType::onlyTrashed()->findOrFail($id);
        if ($echoType->restore()) {
            return back()->with('success', __('alert.message.success.crud.restore'));
        }
        return back()->with('error', __('alert.message.error.crud.restore'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function force_delete($id)
    {
        $echoType = EchoType::onlyTrashed()->findOrFail($id);
        if ($echoType->forceDelete()) {
            return back()->with('success', __('alert.message.success.crud.force_detele'));
        }
        return back()->with('error', __('alert.message.error.crud.force_detele'));
    }
}
