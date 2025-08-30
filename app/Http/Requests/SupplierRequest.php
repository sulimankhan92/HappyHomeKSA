<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SupplierRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
			'name' => 'required|string',
			'company_name' => 'string',
			'vat_number' => 'string',
			'phone_number' => 'string',
			'image' => 'string',
			'country' => 'string',
			'address' => 'string',
			'location_link' => 'string',
			'status' => 'required',
        ];
    }
}
