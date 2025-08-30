<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
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
			'product_total' => 'required',
			'total_tax' => 'required',
			'delivery_cost' => 'required',
			'total_discount' => 'required',
			'total_amount' => 'required',
			'total_amount_paid' => 'required',
			'notes' => 'string',
			'status' => 'required',
        ];
    }
}
