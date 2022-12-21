<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\Medicine;
use App\Models\DataParent;
use App\Models\Prescription;
use App\Models\Doctor;
use Illuminate\Http\Request;
use App\Models\PrescriptionDetail;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\PrescriptionRequest;

class PrescriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->data['rows'] = Prescription::with(['patient', 'gender', 'doctor_requested', 'address'])->select([
            'prescriptions.*',
            'patients.name_en as patient_en', 'patients.name_kh as patient_kh',
            'doctors.name_en as doctor_en', 'doctors.name_kh as doctor_kh',
        ])
            ->filter()
            ->where('prescriptions.status', '>=', 1)
            ->leftJoin('patients', 'patients.id', '=', 'prescriptions.patient_id')
            ->leftJoin('doctors', 'doctors.id', '=', 'prescriptions.doctor_id')
            ->orderBy('id', 'DESC')
            ->limit(5000)
            ->get();
        return view('prescription.index', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            'patient' => Patient::orderBy('name_en', 'asc')->get(),
            'doctor' => Doctor::orderBy('id', 'asc')->get(),
            'payment_type' => getParentDataSelection('payment_type'),
            'gender' => getParentDataSelection('gender'),
            'usages' => getParentDataSelection('comsumption'),
            'time_usage' => getParentDataSelection('time_usage'),
            'medicine' => Medicine::orderBy('name', 'asc')->get(),
            'is_edit' => false
        ];

        return view('prescription.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if ($pre = Prescription::create([
            'code' => generate_code('PRE', 'prescriptions'),
            'patient_id' => $request->patient_id ?: null,
            'age' => $request->age ?: null,
            'age_type' => 1, // Will link with data-patent to get age type and disply dropdown at form
            'doctor_id' => $request->doctor_id ?: null,
            'gender_id' => $request->gender_id ?: null,
            'requested_by' => $request->requested_by ?: Auth()->user()->doctor_id ?: null,
            'payment_type' => $request->payment_type ?: null,
            'payment_status' => 0,
            'requested_at' => $request->requested_at ?: date('Y-m-d H:i:s'),
            'analysis_at' => $request->analysis_at ?: null,
            'diagnosis' => $request->diagnosis,
            'price' => $request->price ?: 0,
            'exchange_rate' => d_exchange_rate(),
            'attribite' => $request->attribite,
        ])) {
            $pre->update(['address_id' => update4LevelAddress($request)]);
            $this->refresh_prescriotion_detail($request, $pre->id, true);
            if ($request->is_treament_plan) {
                return redirect()->route('patient.consultation.edit', $request->consultation_id)->with('success', 'Data created success');
            } else {
                return redirect()->route('prescription.edit', $pre->id)->with('success', 'Data created success');
            }
        }
    }

    /**
     * Display the specified resource.
     */
    public function getDetail(Request $request)
    {
        $row = Prescription::where('prescriptions.id', $request->id)
            ->with([
                'patient',
                'detail' => function ($q) {
                    $q->select([
                        'prescription_details.*',
                        'medicines.name as medicine_name',
                        'data_parents.title_en as usage_en',
                    ])
                        ->leftJoin('medicines', 'medicines.id', '=', 'prescription_details.medicine_id')
                        ->leftJoin('data_parents', 'data_parents.id', '=', 'prescription_details.usage_id');
                }
            ])
            ->first();

        if ($row) {
            $tbody = '';
            foreach ($row->detail as $i => $detail) {
                $j = 0;
                $usage_time_str = '';
                $time_usage = getParentDataSelection('time_usage');
                foreach ($time_usage as $id => $data) {
                    if (in_array($id, explode(',', $detail->usage_times ?? []))) {
                        if ($j == 0) {
                            $usage_time_str = $data;
                            $j++;
                        } else {
                            $usage_time_str .= ' - ' . $data;
                        }
                    }
                }
                $tbody .= '<tr>
						<td class="text-center">' . str_pad(++$i, 2, '0', STR_PAD_LEFT) . '</td>
						<td>' . $detail->medicine_name . '</td>
						<td class="text-center">' . $detail->qty . '</td>
						<td class="text-center">' . $detail->upd . '</td>
						<td class="text-center">' . $detail->nod . '</td>
						<th class="text-center"><strong>' . $detail->total . '</strong></th>
						<td>' . $detail->unit . '</td>
						<td>' . $usage_time_str . '</td>
						<td>' . $detail->usage_en . '</td>
						<td>' . $detail->other . '</td>
					</tr>';
            }
            $body = '<table class="table-form  tw-mt-3 table-detail-result">
					<tr class="text-center">
						<th class="text-center">N&deg;</th>
						<th>Medicine</th>
						<th width="50px">QTY</th>
						<th width="50px">U/D</th>
						<th width="50px">NoD</th>
						<th width="50px">Total</th>
						<th width="50px">Unit</th>
						<th width="160px">Usage Time</th>
						<th>Usage</th>
						<th>Note</th>
					</tr>
					' . (($tbody == '') ? '<tr colspan="10" class="text-center">No result</td>' : $tbody) . '
				</table>';

            return response()->json([
                'success' => true,
                'header' => getParaClinicHeaderDetail($row),
                'body' => $body,
                'print_url' => route('prescription.print', $row->id),
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'X-Ray not found!',
            ], 404);
        }
    }

    public function print($id)
    {
        $prescription = Prescription::select([
            'prescriptions.*',
            'patients.name_en as patient_kh',
            'patients.age as patient_age',
            'genders.title_en as patient_gender',
            'doctors.name_en as doctor_en',
        ])
            ->where('prescriptions.id', $id)
            ->with([
                'detail' => function ($q) {
                    $q->select([
                        'prescription_details.*',
                        'medicines.name as medicine_name',
                        'data_parents.title_en as usage_en',
                    ])
                        ->leftJoin('medicines', 'medicines.id', '=', 'prescription_details.medicine_id')
                        ->leftJoin('data_parents', 'data_parents.id', '=', 'prescription_details.usage_id');
                }
            ])
            ->leftJoin('patients', 'patients.id', '=', 'prescriptions.patient_id')
            ->leftJoin('data_parents AS genders', 'genders.id', '=', 'patients.gender')
            ->leftJoin('doctors', 'doctors.id', '=', 'prescriptions.doctor_id')
            ->first();
        if ($prescription) {
            $data['row'] = $prescription;
            $data['usages'] = getParentDataSelection('comsumption');
            $data['time_usage'] = getParentDataSelection('time_usage');
            return view('prescription.print', $data);
        } else {
            abort(404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Prescription $prescription)
    {
        $data = [
            'row'=>  $prescription,
            'patient' => Patient::orderBy('name_en', 'asc')->get(),
            'doctor' => Doctor::orderBy('id', 'asc')->get(),
            'payment_type' => getParentDataSelection('payment_type'),
            'gender' => getParentDataSelection('gender'),
            'usages' => getParentDataSelection('comsumption'),
            'time_usage' => getParentDataSelection('time_usage'),
            'medicine' => Medicine::orderBy('name', 'asc')->get(),
            'prescription_detail' => $prescription->detail()->get(),
            'is_edit' => true
        ];

        return view('prescription.edit', $data);
    }

    public function show(Prescription $prescription)
    {
        if ($prescription ?? false) {
            $data['row'] = $prescription;
            $data['patient'] = Patient::orderBy('name_en', 'asc')->get();
            $data['doctor'] = Doctor::orderBy('id', 'asc')->get();
            $data['medicine'] = Medicine::orderBy('name', 'asc')->get();
            $data['usages'] = getParentDataSelection('comsumption');
            $data['time_usage'] = getParentDataSelection('time_usage');
        }
        $data['prescription_detail'] = $prescription->detail()->get();
        $data['is_edit'] = true;
        return view('prescription.show', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Prescription $prescription)
    {   
        $request['address_id'] = update4LevelAddress($request, $prescription->address_id);

        if ($prescription->update($request->except(['total', 'other']))) {
            $this->refresh_prescriotion_detail($request, $prescription->id);
            return redirect()->route('prescription.index')->with('success', 'Data update success');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Prescription $prescription)
    {
        if ($prescription->delete()) {
            return redirect()->route('prescription.index')->with('success', 'Data delete success');
        }
    }

    public function refresh_prescriotion_detail($request, $id_prescription = 0, $is_new = false)
    {
        // Do update the labor detail
        $detail_ids = $request->test_id ?: [];
        $detail_values = [];

        // #1, Bind values from post
        foreach ($detail_ids as $index => $id) {
            $detail_values[$is_new ? $index : $id] = [
                'id'            => $id,
                'medicine_id'     => $request->medicine_id[$index] ?: 0,
                'qty'             => $request->qty[$index] ?: 0,
                'upd'             => $request->upd[$index] ?: 0,
                'nod'             => $request->nod[$index] ?: 0,
                'total'         => $request->total[$index] ?: 0,
                'unit'             => $request->unit[$index] ?: '',
                'usage_id'         => $request->usage_id[$index] ?: 0,
                'usage_times'     => [],
                'other'         => $request->other[$index] ?: '',
            ];
        }

        // #2, Bind time usage values from checkbox
        $time_usage = getParentDataSelection('time_usage');
        foreach ($detail_values as $id => $val) {
            $tmp_usage_time = [];
            foreach ($time_usage as $tm_id => $tm_name) {
                if (
                    isset($request->{'time_usage_' . $val['id'] . '_' . $tm_id}) || // For edit
                    isset($request->{'time_usage_' . $tm_id}[$id]) && $request->{'time_usage_' . $tm_id}[$id] != "OFF" // For create
                ) {
                    $tmp_usage_time[] = $tm_id;
                }
            }
            $detail_values[$id]['usage_times'] = implode(',', $tmp_usage_time ?: []);
        }

        if ($is_new == false) {
            // #3, Update recoed database
            foreach ($detail_values as $id => $val) {
                PrescriptionDetail::find($id)->update($val);
            }

            // #4, Clean old data when clicked on icon trast/delete
            if (sizeof($detail_ids) > 0) {
                $detailToDelete = PrescriptionDetail::where('prescription_id', $id_prescription)->whereNotIn('id', $detail_ids);
                $detailToDelete->delete();
            }
        } else {
            // #5, Insert new data
            foreach ($detail_values as $id => $val) {
                unset($val['id']);
                $val['prescription_id'] = $id_prescription;
                $detail = new PrescriptionDetail;
                $detail->create($val);
            }
        }
    }
}
