<?php

namespace App\Livewire\Forms;

use App\Models\CouponAssignedUser;
use Livewire\Form;

class CouponAssignedUserForm extends Form
{
    public ?CouponAssignedUser $couponAssignedUserModel;
    
    public $coupon_id = '';
    public $user_id = '';
    public $assigned_by_user_id = '';
    public $used_count = '';
    public $is_active = '';

    public function rules(): array
    {
        return [
			'used_count' => 'required',
			'is_active' => 'required',
        ];
    }

    public function setCouponAssignedUserModel(CouponAssignedUser $couponAssignedUserModel): void
    {
        $this->couponAssignedUserModel = $couponAssignedUserModel;
        
        $this->coupon_id = $this->couponAssignedUserModel->coupon_id;
        $this->user_id = $this->couponAssignedUserModel->user_id;
        $this->assigned_by_user_id = $this->couponAssignedUserModel->assigned_by_user_id;
        $this->used_count = $this->couponAssignedUserModel->used_count;
        $this->is_active = $this->couponAssignedUserModel->is_active;
    }

    public function store(): void
    {
        $this->couponAssignedUserModel->create($this->validate());

        $this->reset();
    }

    public function update(): void
    {
        $this->couponAssignedUserModel->update($this->validate());

        $this->reset();
    }
}
