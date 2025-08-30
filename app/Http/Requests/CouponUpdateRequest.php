<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CouponUpdateRequest extends FormRequest
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
            'code' => 'required',
            'title_en' => 'required|string',
            'title_ar' => 'required|string',
            'description_en' => 'string',
            'description_ar' => 'string',
            'coupon_use_counts' => 'required',
            'coupon_category' => 'required',
            'type' => 'required',
            'is_for_all_users' => 'required',
            'minimum_order_amount' => 'required',
            'is_active' => 'required',
        ];
    }
}
