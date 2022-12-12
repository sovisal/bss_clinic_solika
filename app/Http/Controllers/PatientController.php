<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\DataParent;
use App\Models\Consultation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Http\Requests\PatientRequest;
use Intervention\Image\Facades\Image;
use Illuminate\Database\Eloquent\Collection;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'patients' => Patient::webDevTrashed()
                ->with(['address', 'user', 'consultations'])
                ->orderBy('id', 'desc')->get()
        ];
        return view('patient.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = array_merge(
            ['addresses' => get4LevelAdressSelector('xx', 'option'),],
            getParentDataSelection([
                'blood_type',
                'nationality',
                'gender',
                'marital_status',
                'enterprise'
            ])
        );
        return view('patient.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PatientRequest $request)
    {
        $address_id = update4LevelAddress($request);
        $patient = Patient::create($this->compileRequestColumns($request, $address_id));
        if ($patient) {
            Consultation::create([
                'patient_id' => $patient->id,
                'doctor_id' => 1,
                'payment_type' => null,
                'evaluated_at' => now(),
                'attribute' => '',
                'status' => '1',
                'user_id' => auth()->user()->id,
            ]);
        }

        if ($request->ajax()) {
            return $patient;
        }

        if ($request->file('photo')) {
            $path = public_path('/images/patients/');
            File::makeDirectory($path, 0777, true, true);
            $photo = $request->file('photo');
            $photo_name = time() . '_' . $patient->id . '.png';
            Image::make($photo->getRealPath())->save($path . $photo_name);
            $patient->update(['photo' => $photo_name]);
        }

        return redirect()->route('patient.show', $patient->id)->with('success', __('alert.message.success.crud.create'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Patient $patient)
    {
        $patient->load([
            'address',
            'prescriptions' => function ($q) {
                $q->select([
                    'prescriptions.*',
                    'patients.name_en as patient_en', 'patients.name_kh as patient_kh',
                    'requesters.name_en as requester_en', 'requesters.name_kh as requester_kh',
                    'doctors.name_en as doctor_en', 'doctors.name_kh as doctor_kh',
                ])
                    ->leftJoin('patients', 'patients.id', '=', 'prescriptions.patient_id')
                    ->leftJoin('doctors as requesters', 'requesters.id', '=', 'prescriptions.requested_by')
                    ->leftJoin('doctors', 'doctors.id', '=', 'prescriptions.doctor_id');
            },
            'labors' => function ($q) {
                $q->select([
                    'laboratories.*',
                    'patients.name_en as patient_en', 'patients.name_kh as patient_kh',
                    'requesters.name_en as requester_en', 'requesters.name_kh as requester_kh',
                    'doctors.name_en as doctor_en', 'doctors.name_kh as doctor_kh',
                ])
                    ->leftJoin('patients', 'patients.id', '=', 'laboratories.patient_id')
                    ->leftJoin('doctors as requesters', 'requesters.id', '=', 'laboratories.requested_by')
                    ->leftJoin('doctors', 'doctors.id', '=', 'laboratories.doctor_id');
            },
            'xrays' => function ($q) {
                $q->select([
                    'xrays.*',
                    'patients.name_en as patient_en', 'patients.name_kh as patient_kh',
                    'requesters.name_en as requester_en', 'requesters.name_kh as requester_kh',
                    'doctors.name_en as doctor_en', 'doctors.name_kh as doctor_kh',
                ])
                    ->leftJoin('patients', 'patients.id', '=', 'xrays.patient_id')
                    ->leftJoin('doctors as requesters', 'requesters.id', '=', 'xrays.requested_by')
                    ->leftJoin('doctors', 'doctors.id', '=', 'xrays.doctor_id');
            },
            'echos' => function ($q) {
                $q->select([
                    'echographies.*',
                    'patients.name_en as patient_en', 'patients.name_kh as patient_kh',
                    'requesters.name_en as requester_en', 'requesters.name_kh as requester_kh',
                    'doctors.name_en as doctor_en', 'doctors.name_kh as doctor_kh',
                ])
                    ->leftJoin('patients', 'patients.id', '=', 'echographies.patient_id')
                    ->leftJoin('doctors as requesters', 'requesters.id', '=', 'echographies.requested_by')
                    ->leftJoin('doctors', 'doctors.id', '=', 'echographies.doctor_id');
            },
            'ecgs' => function ($q) {
                $q->select([
                    'ecgs.*',
                    'patients.name_en as patient_en', 'patients.name_kh as patient_kh',
                    'requesters.name_en as requester_en', 'requesters.name_kh as requester_kh',
                    'doctors.name_en as doctor_en', 'doctors.name_kh as doctor_kh',
                ])
                    ->leftJoin('patients', 'patients.id', '=', 'ecgs.patient_id')
                    ->leftJoin('doctors as requesters', 'requesters.id', '=', 'ecgs.requested_by')
                    ->leftJoin('doctors', 'doctors.id', '=', 'ecgs.doctor_id');
            },
        ]);
        $consultation = Consultation::where('patient_id', $patient->id)->get();
        $save_consultation = $consultation->where('status', 1)->first();
        $exist_consultation = $consultation->first();
        if ($save_consultation) {
            return redirect()->route('patient.consultation.edit', $save_consultation->id);
        } else if (!$exist_consultation) {
            return redirect()->route('patient.consultation.create', ['patient' => $patient->id]);
        }

        $history = new Collection;
        $history = $history->concat($patient->prescriptions->map(function ($row) {
            $row->row_type = 'prescription';
            $row->url = route('prescription.print', $row->id);
            return $row;
        }));
        $history = $history->concat($patient->labors->map(function ($row) {
            $row->row_type = 'labor';
            $row->url = route('para_clinic.labor.print', $row->id);
            return $row;
        }));
        $history = $history->concat($patient->xrays->map(function ($row) {
            $row->row_type = 'xray';
            $row->url = route('para_clinic.xray.print', $row->id);
            return $row;
        }));
        $history = $history->concat($patient->echos->map(function ($row) {
            $row->row_type = 'echo';
            $row->url = route('para_clinic.echography.print', $row->id);
            return $row;
        }));
        $history = $history->concat($patient->ecgs->map(function ($row) {
            $row->row_type = 'ecg';
            $row->route_name = 'para_clinic.ecg';
            return $row;
        }));
        $patient->history = $history->sortByDesc('requested_at');

        $data = [
            'patient' => $patient,
        ];
        return view('patient.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Patient $patient)
    {
        $data = array_merge(
            [
                'patient' => $patient,
                'addresses' => get4LevelAdressSelectorByID($patient->address_id, ...['xx', 'option']),
            ],
            getParentDataSelection([
                'blood_type',
                'nationality',
                'gender',
                'marital_status',
                'enterprise'
            ])
        );
        return view('patient.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PatientRequest $request, Patient $patient)
    {
        $address_id = update4LevelAddress($request);
        $patient->update($this->compileRequestColumns($request, $address_id));

        if ($patient->address_id) {
            $request->address_id = $patient->address_id;
            update4LevelAddress($request);
        }

        if ($request->file('photo')) {
            $path = public_path('/images/patients/');
            File::makeDirectory($path, 0777, true, true);
            $photo = $request->file('photo');
            $patient_photo = (($patient->photo != '') ? $patient->photo : time() . '_' . $patient->id . '.png');
            Image::make($photo->getRealPath())->save($path . $patient_photo);
            $patient->update(['photo' => $patient_photo]);
        }

        return redirect()->back()->with('success', __('alert.message.success.crud.update'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Patient $patient)
    {
        $address_id = $patient->address_id;
        $patient_photo = $patient->photo;
        if ($patient->delete()) {
            $old_path = public_path('/images/patients/' . $patient_photo);
            if (File::exists($old_path)) {
                File::delete($old_path);
            }

            if ($address_id && $address_id > 0) delete4LevelAddress($address_id);
            return back()->with('success', __('alert.message.success.crud.delete'));
        }
        return back()->with('error', __('alert.message.error.crud.delete'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function restore($id)
    {
        $user = Patient::onlyTrashed()->findOrFail($id);
        if ($user->restore()) {
            return back()->with('success', __('alert.message.success.crud.restore'));
        }
        return back()->with('error', __('alert.message.error.crud.restore'));
    }

    // get Product Select2
    public function getSelect2()
    {
        return Patient::getSelect2(['status' => 'active'], ['name_kh', 'asc'], ['id', 'name_kh']);
    }

    public function getSelectDetail(Request $request)
    {
        $patient = Patient::find($request->id);

        $return_result['patient'] = $patient;
        if ($patient->address_id) {
            $return_result['address'] = get4LevelAdressSelectorByID($patient->address_id, ...['xx', 'option']);
        }
        return response()->json($return_result);
    }

    public function compileRequestColumns($request, $address_id)
    {
        return [
            'name_kh' => $request->name_kh,
            'name_en' => $request->name_en,
            'id_card_no' => $request->id_card_no,
            'email' => $request->email,
            'phone' => $request->phone,
            'date_of_birth' => $request->date_of_birth,
            'age' => $request->age,
            'education' => $request->education,
            'position' => $request->position,
            'father_name' => $request->father_name,
            'father_position' => $request->father_position,
            'mother_name' => $request->mother_name,
            'mother_position' => $request->mother_position,
            'house_no' => $request->house_no,
            'street_no' => $request->street_no,
            'postal_code' => $request->postal_code,
            'address_id' => $address_id,
            'registered_at' => $request->registered_at,
            'gender_id' => $request->gender_id,
            'marital_status_id' => $request->marital_status_id,
            'nationality_id' => $request->nationality_id,
            'enterprise_id' => $request->enterprise_id,
            'blood_type_id' => $request->blood_type_id,
        ];
    }
}
