<?php

namespace App\Livewire\Coupons;

use App\Livewire\Forms\CouponForm;
use App\Models\Coupon;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Show extends Component
{
    public CouponForm $form;

    public function mount(Coupon $coupon)
    {
        $this->form->setCouponModel($coupon);
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.coupon.show', ['coupon' => $this->form->couponModel]);
    }
}
