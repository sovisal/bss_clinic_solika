<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {
        $data = [
            'services' => Service::where('status', '>=', 1)->with('user')->get(),
        ];
        return view('service.index', $data);
    }

    public function create()
    {
        return view('service.create');
    }

    public function store(Request $request)
    {
        $service = Service::create([
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description
        ]);

        if ($request->ajax()) {
            return $service;
        } else {
            $url = route('invoice.service.index');
            if ($request->save_opt == 'save_create') {
                $url = route('invoice.service.create');
            } else if ($request->save_opt == 'save_edit') {
                $url = route('invoice.service.edit', $service->id);
            }
            return redirect($url)->with('success', __('alert.message.success.crud.create'));
        }
    }

    public function edit(Service $service)
    {
        $data['row'] = $service;
        return view('service.edit', $data);
    }

    public function update(Request $request, Service $service)
    {
        $service->update([
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
        ]);
        return redirect()->route('invoice.service.index')->with('success', __('alert.message.success.crud.update'));
    }

    public function destroy(Service $service)
    {
        if ($service->delete()) {
            return back()->with('success', __('alert.message.success.crud.delete'));
        }
        return back()->with('error', __('alert.message.error.crud.delete'));
    }
}
