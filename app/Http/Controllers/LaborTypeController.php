<?php

namespace App\Http\Controllers;

use App\Models\LaborType;
use App\Http\Requests\LaborTypeRequest;

class LaborTypeController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index()
	{
		$laborTypes = LaborType::where('labor_types.status', 1)
			->when(request()->type, function($q){
				$q->where('labor_types.id', request()->type)
				->select(['labor_types.*','labor_parents.name_en as type_name'])
				->leftJoin('labor_types as labor_parents', 'labor_parents.id', '=' ,'labor_types.type');
			})
			->with([
				'items' => function($query){
					$query->orderBy('index', 'asc');
				},
				'types' => function($query){
					$query->with(['items', 'types'])
					->orderBy('index', 'asc');
				}
			])
			->orderBy('labor_types.index', 'asc')
			->get();
			
		$data['LaborLevel'][] = request()->old ? LaborType::find(request()->old) : null;
		$data['LaborLevel'][] = $laborTypes->where('id', request()->type)->first();
		$data['rows'] = ((count($laborTypes) == 1)? $laborTypes->first()->types : $laborTypes->whereNull('type'));
		$data['item_rows'] = ((request()->type && $laborTypes->first())? $laborTypes->first()->items : []);
		return view('labor_type.index', $data);
	}

	/**
	 * Show the form for creating a new resource.
	 */
	public function create()
	{
		$data['type'] = request()->type;
		return view('labor_type.create', $data);
	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function store(LaborTypeRequest $request)
	{
		$type = $request->type;
		$laborType = LaborType::create([
			'name_kh' => $request->name,
			'name_en' => $request->name,
			'type' => $type,
			'created_by' => auth()->user()->id,
			'updated_by' => auth()->user()->id
		]);
		$url = route('setting.labor-type.index', ['type' => $type]);
		if ($request->save_opt == 'save_create') {
			$url = route('setting.labor-type.create', ['type' => $type]);
		} else if ($request->save_opt == 'save_edit') {
			$url = route('setting.labor-type.edit', ['laborType' => $laborType->id, 'type' => $type]);
		}
		return redirect($url)->with('success', __('alert.message.success.crud.create'));
	}

	/**
	 * Show the form for editing the specified resource.
	 */
	public function edit(LaborType $laborType)
	{
		$data['type'] = request()->type;
		$data['row'] = $laborType;
		return view('labor_type.edit', $data);
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(LaborTypeRequest $request, LaborType $laborType)
	{
		$laborType->update([
			'name_kh' => $request->name,
			'name_en' => $request->name,
			'created_by' => auth()->user()->id,
			'updated_by' => auth()->user()->id,
		]);
		return redirect(route('setting.labor-type.index', ['type' => request()->type]))->with('success', __('alert.message.success.crud.update'));
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(LaborType $laborType)
	{
		if ($laborType->update(['status' => 0])) {
			return redirect(route('setting.labor-type.index', ['type' => request()->type]))->with('success', 'Data delete success');
		}
	}
}
