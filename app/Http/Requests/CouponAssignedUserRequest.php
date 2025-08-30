<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CouponAssignedUserRequest extends FormRequest
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
//			'used_count' => 'required',
			'coupon_id' => 'required',
			'user_id' => 'required',
			'is_active' => 'required',
        ];
    }
}
