<?php

namespace App\Livewire\Forms;

use App\Models\CouponUser;
use Livewire\Form;

class CouponUserForm extends Form
{
    public ?CouponUser $couponUserModel;
    
    public $coupon_id = '';
    public $user_id = '';
    public $order_id = '';
    public $used_count = '';

    public function rules(): array
    {
        return [
			'used_count' => 'required',
        ];
    }

    public function setCouponUserModel(CouponUser $couponUserModel): void
    {
        $this->couponUserModel = $couponUserModel;
        
        $this->coupon_id = $this->couponUserModel->coupon_id;
        $this->user_id = $this->couponUserModel->user_id;
        $this->order_id = $this->couponUserModel->order_id;
        $this->used_count = $this->couponUserModel->used_count;
    }

    public function store(): void
    {
        $this->couponUserModel->create($this->validate());

        $this->reset();
    }

    public function update(): void
    {
        $this->couponUserModel->update($this->validate());

        $this->reset();
    }
}
