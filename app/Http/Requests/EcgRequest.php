<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EcgRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'patient_id' => 'required|numeric',
            'doctor_id' => 'required|numeric',
            'payment_type' => 'required|numeric',
            'age' => 'nullable|numeric|min:0|max:150',
            'gender_id' => 'nullable|numeric',
            'type_id' => ( $this->echography ? 'nullable' : 'required' ). '|numeric',
            'requested_by' => ( $this->echography ? 'nullable' : 'required' ). '|numeric',
            'requested_at' => ( $this->echography ? 'nullable' : 'required' ). '|date',
        ];
    }
}
