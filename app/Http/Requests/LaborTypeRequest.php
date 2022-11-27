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
			// , Rule::unique('labor_types', 'name_en')->ignore($this->laborType)->where('status', 1)
			'name' => ['required','string','min:2','max:255'],
		];
	}
}
