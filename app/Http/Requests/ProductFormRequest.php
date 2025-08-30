<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductFormRequest extends FormRequest
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
            'product_manufacture_id' => 'required',
            'secondary_category_id' => 'required|array',
            'product_brand_id' => 'required',
            'supplier_id' => 'required',
            'max_purchase' => 'required',
            'name_en' => 'required|string',
            'name_ar' => 'required|string',
            'description_en' => 'string',
            'description_ar' => 'string',
            'order' => 'required',
            'box_size' => 'required',
            'barcode' => 'required|string',
            'product_location' => 'required|string',
            'status' => 'required',
            'min_purchase' => 'required',
            'country_id' => 'required',
        ];
    }
}
