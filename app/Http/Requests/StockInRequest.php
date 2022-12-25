<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StockInRequest extends FormRequest
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
            // 'date.*' => 'required|date',
            // 'exp_date.*' => 'required|date',
            // 'reciept_no.*' => 'nullable|string|max:255',
            // 'price.*' => 'required|numeric',
            // 'qty.*' => 'required|numeric',
            // 'supplier_id.*' => 'required|numeric',
            // 'product_id.*' => 'required|numeric',
            // 'unit_id.*' => 'nullable|numeric'
        ];
    }
}
