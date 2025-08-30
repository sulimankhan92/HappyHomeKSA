<?php

namespace App\Livewire\Forms;

use App\Models\Coupon;
use Livewire\Form;

class CouponForm extends Form
{
    public ?Coupon $couponModel;
    
    public $created_by = '';
    public $code = '';
    public $title_en = '';
    public $title_ar = '';
    public $description_en = '';
    public $description_ar = '';
    public $coupon_use_counts = '';
    public $coupon_category = '';
    public $type = '';
    public $is_for_all_users = '';
    public $minimum_order_amount = '';
    public $amount = '';
    public $is_active = '';
    public $start_date = '';
    public $end_date = '';

    public function rules(): array
    {
        return [
			'code' => 'required|string',
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

    public function setCouponModel(Coupon $couponModel): void
    {
        $this->couponModel = $couponModel;
        
        $this->created_by = $this->couponModel->created_by;
        $this->code = $this->couponModel->code;
        $this->title_en = $this->couponModel->title_en;
        $this->title_ar = $this->couponModel->title_ar;
        $this->description_en = $this->couponModel->description_en;
        $this->description_ar = $this->couponModel->description_ar;
        $this->coupon_use_counts = $this->couponModel->coupon_use_counts;
        $this->coupon_category = $this->couponModel->coupon_category;
        $this->type = $this->couponModel->type;
        $this->is_for_all_users = $this->couponModel->is_for_all_users;
        $this->minimum_order_amount = $this->couponModel->minimum_order_amount;
        $this->amount = $this->couponModel->amount;
        $this->is_active = $this->couponModel->is_active;
        $this->start_date = $this->couponModel->start_date;
        $this->end_date = $this->couponModel->end_date;
    }

    public function store(): void
    {
        $this->couponModel->create($this->validate());

        $this->reset();
    }

    public function update(): void
    {
        $this->couponModel->update($this->validate());

        $this->reset();
    }
}
