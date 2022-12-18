<?php

namespace App\Http\Controllers;

use App\Models\Xray;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\XrayType;
use Illuminate\Http\Request;
use App\Http\Requests\XrayRequest;

class XrayController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->data['rows'] = Xray::with(['address', 'user', 'doctor', 'patient', 'type', 'address', 'gender'])
            ->filterTrashed()
            ->filter()
            ->orderBy('id', 'desc')
            ->limit(5000)
            ->get();
        return view('xray.index', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            'type' => XrayType::where('status', 1)->orderBy('index', 'asc')->get(),
            'patient' => Patient::orderBy('name_en', 'asc')->get(),
            'doctor' => Doctor::orderBy('id', 'asc')->get(),
            'payment_type' => getParentDataSelection('payment_type'),
            'gender' => getParentDataSelection('gender'),
            'addresses' => get4LevelAdressSelector('xx', 'option'),
            'is_edit' => false
        ];
        return view('xray.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(XrayRequest $request)
    {
        $xray_type = $request->type_id ? XrayType::where('id', $request->type_id)->first() : null;
        if ($xray = Xray::create([
            'code' => generate_code('XRA', 'xrays'),
            'type_id' => $request->type_id ?: null,
            'patient_id' => $request->patient_id ?: null,
            'age' => $request->age ?: null,
            'age_type' => 1, // Will link with data-patent to get age type and disply dropdown at form
            'doctor_id' => $request->doctor_id ?: null,
            'gender_id' => $request->gender_id ?: null,
            'requested_by' => $request->requested_by ?: Auth()->user()->doctor_id ?: null,
            'payment_type' => $request->payment_type ?: null,
            'payment_status' => 0,
            'requested_at' => $request->requested_at,
            'price' => $request->price ?: ($xray_type ? $xray_type->price : 0),
            'exchange_rate' => d_exchange_rate(),
            'attribute' => $xray_type ? $xray_type->attribite : null,
        ])) {
            $xray->update(['address_id' => update4LevelAddress($request)]);
            if ($request->is_treament_plan) {
                return redirect()->route('patient.consultation.edit', $request->consultation_id)->with('success', 'Data created success');
            } else {
                return redirect()->route('para_clinic.xray.edit', $xray->id)->with('success', 'Data created success');
            }
        }
    }

    /**
     * Display the specified resource.
     */
    public function getDetail(Request $request)
    {
        $row = Xray::where('id', $request->id)->with(['patient', 'doctor', 'type', 'doctor_requested', 'payment'])->first();
        if ($row) {
            $body = '';
            $tbody = '';
            $attributes = $row->filterAttr;
            foreach ($attributes as $label => $attr) {
                $tbody .= '<tr>
                                <td width="30%" class="text-right tw-bg-gray-100">' . __('form.xray.' . $label) . '</td>
                                <td>' . $attr . '</td>
                            </tr>';
            }
            $body = '<table class="table-form tw-mt-3 table-detail-result">
                        <thead>
                            <tr>
                                <th colspan="4" class="text-left tw-bg-gray-100">Result</th>
                            </tr>
                        </thead>
                        <tbody>' . ((empty($attributes)) ? '<tr><th colspan="4" class="text-center">No result</th></tr>' : $tbody) . '</tbody>
                    </table>';
            return response()->json([
                'success' => true,
                'header' => getParaClinicHeaderDetail($row),
                'body' => $body,
                'print_url' => route('para_clinic.xray.print', $row->id),
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Xray not found!',
            ], 404);
        }
    }

    /**
     * Print the specified resource.
     */
    public function print($id)
    {
        $xray = Xray::select([
            'xrays.*',
            'patients.name_en as patient_kh',
            'patients.age as patient_age',
            'data_parents.title_en as patient_gender',
            'doctors.name_en as doctor_en',
            'xray_types.name_en as type_en'
        ])
            ->leftJoin('patients', 'patients.id', '=', 'xrays.patient_id')
            ->leftJoin('data_parents', 'data_parents.id', '=', 'patients.gender')
            ->leftJoin('doctors', 'doctors.id', '=', 'xrays.doctor_id')
            ->leftJoin('xray_types', 'xray_types.id', '=', 'xrays.type')
            ->find($id);
        $xray->attribute = array_except(filter_unit_attr(unserialize($xray->attribute) ?: []), ['status', 'amount', 'payment_type', 'requested_by']);
        $data['xray'] = $xray;
        return view('xray.print', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Xray $xray)
    {
        append_array_to_obj($xray, unserialize($xray->attribute) ?: []);
        if ($xray ?? false) {
            $data['row'] = $xray;
            $data['type'] = XrayType::where('status', 1)->orderBy('index', 'asc')->get();
            $data['patient'] = Patient::orderBy('name_en', 'asc')->get();
            $data['doctor'] = Doctor::orderBy('id', 'asc')->get();
        }
        $data['payment_type'] = getParentDataSelection('payment_type');
        $data['is_edit'] = true;
        return view('xray.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Xray $xray)
    {
        // serialize all post into string
        $serialize = array_except($request->all(), ['_method', '_token']);
        $request['attribute'] = serialize($serialize);
        $request['amount'] = $request->amount ?? 0;
        // $request['doctor_id'] = $request->doctor_id ?? 0;

        if ($xray->update($request->all())) {
            return redirect()->route('para_clinic.xray.index')->with('success', 'Data update success');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Xray $xray)
    {
        $xray->status = 0;
        if ($xray->update()) {
            return redirect()->route('para_clinic.xray.index')->with('success', 'Data delete success');
        }
    }

    public function show(Xray $xray)
    {
        append_array_to_obj($xray, unserialize($xray->attribute) ?: []);
        if ($xray ?? false) {
            $data['row'] = $xray;
            $data['type'] = XrayType::where('status', 1)->orderBy('index', 'asc')->get();
            $data['patient'] = Patient::orderBy('name_en', 'asc')->get();
            $data['doctor'] = Doctor::orderBy('id', 'asc')->get();
        }
        $data['payment_type'] = getParentDataSelection('payment_type');
        $data['is_edit'] = true;
        return view('xray.show', $data);
    }
}
