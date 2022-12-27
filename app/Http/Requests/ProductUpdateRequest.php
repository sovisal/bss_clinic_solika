<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class ProductUpdateRequest extends FormRequest
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
            'code' => ['required', 'string', 'min:1', 'max:255', Rule::unique('products')->ignore($this->product)->whereNull('deleted_at')],
            'name_kh' => 'required|string|min:2|max:255',
            'name_en' => 'nullable|string|min:2|max:255',
            'category_id' => 'required|numeric',
            'unit_id' => 'nullable|numeric',
            'type_id' => 'required|numeric',
            'cost' => 'nullable|numeric',
            'price' => 'nullable|numeric',
            'qty_begin' => 'nullable|numeric',
            'qty_alert' => 'nullable|numeric',
        ];
    }
}
