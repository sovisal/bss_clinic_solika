<?php

namespace App\Http\Controllers;

use App\Models\Ecg;
use App\Models\Doctor;
use App\Models\EcgType;
use App\Models\Patient;
use Illuminate\Http\Request;
use App\Http\Requests\EcgRequest;

class EcgController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->data['rows'] = Ecg::with(['address', 'user', 'doctor', 'patient', 'type', 'address', 'gender'])
            ->filterTrashed()
            ->filter()
            ->orderBy('id', 'desc')
            ->limit(5000)
            ->get();
        return view('ecg.index', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            'type' => EcgType::where('status', 1)->orderBy('index', 'asc')->get(),
            'patient' => Patient::orderBy('name_en', 'asc')->get(),
            'doctor' => Doctor::orderBy('id', 'asc')->get(),
            'payment_type' => getParentDataSelection('payment_type'),
            'gender' => getParentDataSelection('gender'),
            'addresses' => get4LevelAdressSelector('xx', 'option'),
            'is_edit' => false
        ];
        return view('ecg.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EcgRequest $request)
    {
        $ecg_type = $request->type_id ? EcgType::where('id', $request->type_id)->first() : null;
        if ($ecg = Ecg::create([
            'code' => generate_code('ECG', 'ecgs'),
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
            'price' => $request->price ?: ($ecg_type ? $ecg_type->price : 0),
            'exchange_rate' => d_exchange_rate(),
            'attribute' => $ecg_type ? $ecg_type->attribite : null,
        ])) {
            $ecg->update(['address_id' => update4LevelAddress($request)]);
            if ($request->is_treament_plan) {
                return redirect()->route('patient.consultation.edit', $request->consultation_id)->with('success', 'Data created success');
            } else {
                return redirect()->route('para_clinic.ecg.edit', $ecg->id)->with('success', 'Data created success');
            }
        }
    }

    /**
     * Display the specified resource.
     */
    public function getDetail(Request $request)
    {
        $row = Ecg::where('id', $request->id)->with(['patient', 'doctor', 'type', 'doctor_requested', 'payment'])->first();
        if ($row) {
            $body = '';
            $tbody = '';
            $attributes = $row->filterAttr;
            foreach ($attributes as $label => $attr) {
                $tbody .= '<tr>
                                <td width="30%" class="text-right tw-bg-gray-100">' . __('form.ecg.' . $label) . '</td>
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
                'print_url' => route('para_clinic.ecg.print', $row->id),
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Ecg not found!',
            ], 404);
        }
    }

    /**
     * Print the specified resource.
     */
    public function print($id)
    {
        $data['ecg'] = Ecg::with(['patient', 'gender', 'doctor', 'type'])->find($id);
        return view('ecg.print', $data);
    }

    // public function show(Ecg $ecg)
    // {
    //     append_array_to_obj($ecg, unserialize($ecg->attribute) ?: []);
    //     if ($ecg ?? false) {
    //         $data['row'] = $ecg;
    //         $data['type'] = EcgType::where('status', 1)->orderBy('index', 'asc')->get();
    //         $data['patient'] = Patient::orderBy('name_en', 'asc')->get();
    //         $data['doctor'] = Doctor::orderBy('id', 'asc')->get();
    //     }
    //     $data['payment_type'] = getParentDataSelection('payment_type');
    //     $data['is_edit'] = true;
    //     return view('ecg.show', $data);
    // }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ecg $ecg)
    {
        append_array_to_obj($ecg, unserialize($ecg->attribute) ?: []);
        $data = [
            'row' => $ecg,
            'type' => EcgType::where('status', 1)->orderBy('index', 'asc')->get(),
            'patient' => Patient::orderBy('name_en', 'asc')->get(),
            'doctor' => Doctor::orderBy('id', 'asc')->get(),
            'addresses' => get4LevelAdressSelectorByID($ecg->address_id, ...['xx', 'option']),
            'payment_type' => getParentDataSelection('payment_type'),
            'gender' => getParentDataSelection('gender'),
            'is_edit' => true,
        ];

        return view('ecg.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Ecg $ecg)
    {
        // serialize all post into string
        $serialize = array_except($request->all(), ['_method', '_token', 'img_1', 'img_2', 'file-browse-img_1', 'file-browse-img_2']);
        $request['attribute'] = serialize($serialize);

        $ecg_type = $request->type_id ? EcgType::where('id', $request->type_id)->first() : null;

        $request['price'] = $request->price ?: ($ecg_type ? $ecg_type->price : 0);
        $request['address_id'] = update4LevelAddress($request, $ecg->address_id);

        if ($ecg->update($request->all())) {
            return redirect()->route('para_clinic.ecg.index')->with('success', 'Data update success');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ecg $ecg)
    {
        if ($ecg->delete()) {
            return redirect()->route('para_clinic.ecg.index')->with('success', 'Data delete success');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function restore($id)
    {
        $ecg = Ecg::onlyTrashed()->findOrFail($id);
        if ($ecg->restore()) {
            return back()->with('success', __('alert.message.success.crud.restore'));
        }
        return back()->with('error', __('alert.message.error.crud.restore'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function force_delete($id)
    {
        $ecg = Ecg::onlyTrashed()->findOrFail($id);
        if ($ecg->forceDelete()) {
            return back()->with('success', __('alert.message.success.crud.force_detele'));
        }
        return back()->with('error', __('alert.message.error.crud.force_detele'));
    }

}
