<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DeliveryPackageRequest extends FormRequest
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
			'name_ar' => 'required|string',
			'name_en' => 'required|string',
			'price' => 'required',
			'urgent_price' => 'required',
			'time_slot' => 'required|string',
			'status' => 'required',
        ];
    }
}
