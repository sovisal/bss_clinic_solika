<?php

namespace App\Http\Controllers;

use App\Models\DataParent;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class DataParentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $type = $request->type ?: session('data_parent_type') ?? 'blood_type';
        $this->data['type'] = $type;
        $this->data['rows'] = DataParent::with(['user'])->where('type', $type)->where('status', 1)->get();

        // 2 level selection
        $this->data['module_conf'] = $module_conf = data_parent_selection_conf()[$type];
        if ($module_conf['is_child'] ?? false) {
            $this->data['parent_module_conf'] = data_parent_selection_conf()[$module_conf['child_of']];
            $this->data['parent_list'] = getParentDataSelection($module_conf['child_of']);
        }

        session(['data_parent_type' => $type]);
        return view('data_parent.index', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $type = session('data_parent_type') ?? 'blood_type';
        $this->data['module_conf'] = $module_conf = data_parent_selection_conf()[$type];
        if ($module_conf['is_child'] ?? false) {
            $this->data['parent_module_conf'] = data_parent_selection_conf()[$module_conf['child_of']];
            $this->data['parent_list'] = getParentDataSelection($module_conf['child_of']);
        }
        return view('data_parent.create', $this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreDataParentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $dataParent = new DataParent();
        $type = session('data_parent_type') ?? 'other';

        if ($dataParent->create([
            'title_en' => $request->title_en,
            'title_kh' => $request->title_kh,
            'description' => $request->description,
            'parent_id' => $request->parent_id ?: 0,
            'type' => $type,
        ])) {
            return redirect()->route('setting.data-parent.index')->with('success', __('alert.message.success.crud.create'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DataParent  $dataParent
     * @return \Illuminate\Http\Response
     */
    public function show(DataParent $dataParent)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DataParent  $dataParent
     * @return \Illuminate\Http\Response
     */
    public function edit(DataParent $dataParent)
    {
        $data = [];
        $type = session('data_parent_type') ?? 'blood_type';
        $data['row'] = $dataParent;
        $data['module_conf'] = $module_conf = data_parent_selection_conf()[$type];

        if ($module_conf['is_child'] ?? false) {
            $data['parent_module_conf'] = data_parent_selection_conf()[$module_conf['child_of']];
            $data['parent_list'] = getParentDataSelection($module_conf['child_of']);
        }
        return view('data_parent.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateDataParentRequest  $request
     * @param  \App\Models\DataParent  $dataParent
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DataParent $dataParent)
    {
        $type = session('data_parent_type') ?? 'other';
        $request['status'] = 1;
        if ($dataParent->update($request->all())) {
            return redirect()->route('setting.data-parent.index')->with('success', __('alert.message.success.crud.update'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DataParent  $dataParent
     * @return \Illuminate\Http\Response
     */
    public function destroy(DataParent $dataParent)
    {
        if ($dataParent->delete()) {
            return redirect()->route('setting.data-parent.index')->with('success', __('alert.message.success.crud.delete'));
        }
    }

    /* Function to get value of data-parent (For table display)
    * Can be used in table display
    * example :  {{ (\App\Http\Controllers\DataParentController::getParentDataByType('nationality', 1)) }} type + id
    * this function is store in session for performance purpose
    */
    static function getParentDataByType($type, $id)
    {
        if (empty($type) || empty($id)) {
            return '';
        }

        $backup_type = session('backup_type') ?? '';
        $backup_rows = session('backup_rows') ?? [];
        if ($type && $backup_rows && $type == $backup_type && sizeof($backup_rows) > 0) {
            $rows = $backup_rows;
        } else {
            $rows = [];
            array_map(function ($obj) use (&$rows) {
                $rows[$obj['id']] = $obj;
            }, DataParent::where('type', $type)->get()->toArray());
            session(['backup_type' => $type]);
            session(['backup_rows' => $rows]);
        }

        if (sizeof($rows) > 0) {
            return array_key_exists($id, $rows) ? render_synonyms_name($rows[$id]['title_en'], $rows[$id]['title_kh']) : '';
        }
        return '';
    }

    /* Function to get value of data-parent (For dropdown selection)
    * Can be used in form selection
    * example :  {{ (\App\Http\Controllers\DataParentController::getParentDataSelection('nationality')) }} type
    */
    static function getParentDataSelection($type = '', $where_clause = [])
    {
        $rows = [];
        if (!$type) {
            return [];
        } else if (is_array($type)) {
            $data_parents = DataParent::type($type)->where($where_clause ?: ['status' => 1])->orderBy('title_en', 'asc')->get();
            array_map(function ($t) use (&$rows, $data_parents) {
                $rows[Str::plural($t, 2)] = $data_parents->where('type', $t)
                    ->map(function ($data_parent) {
                        $data_parent->render_title = render_synonyms_name($data_parent->title_en, $data_parent->title_kh);
                        return $data_parent;
                    })
                    ->pluck('render_title', 'id')->toArray();
            }, $type);
        } else {
            array_map(function ($obj) use (&$rows) {
                $rows[$obj['id']] = render_synonyms_name($obj['title_en'], $obj['title_kh']);
            }, DataParent::where('type', $type)->where($where_clause ?: ['status' => 1])->orderBy('title_en', 'ASC')->get()->toArray());
        }
        
        return $rows;
    }
}
