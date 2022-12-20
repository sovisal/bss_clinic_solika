<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EchographyRequest extends FormRequest
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
            'age' => 'nullable|numeric|min:0|max:150',
            'gender_id' => 'nullable|numeric',
            'payment_type' => ( $this->is_treament_plan ? 'nullable' : 'required' ). '|numeric',
            'type_id' => ( $this->echography ? 'nullable' : 'required' ). '|numeric',
            'requested_by' => ( $this->echography || $this->is_treament_plan ? 'nullable' : 'required' ). '|numeric',
            'requested_at' => ( $this->echography ? 'nullable' : 'required' ). '|date',
        ];
    }
}
