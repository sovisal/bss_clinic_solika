<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class LaborTypeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules()
    {
        return [
            'name_kh' => 'required|string|min:2|max:255',
            'name_en' => 'nullable|string|min:2|max:255',
            'index' => 'nullable|numeric',
            'type' => 'nullable|numeric',
        ];
    }
}
