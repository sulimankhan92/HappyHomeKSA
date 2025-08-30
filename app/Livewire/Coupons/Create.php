<?php

namespace App\Livewire\Coupons;

use App\Livewire\Forms\CouponForm;
use App\Models\Coupon;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Create extends Component
{
    public CouponForm $form;

    public function mount(Coupon $coupon)
    {
        $this->form->setCouponModel($coupon);
    }

    public function save()
    {
        $this->form->store();

        return $this->redirectRoute('coupons.index', navigate: true);
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.coupon.create');
    }
}
