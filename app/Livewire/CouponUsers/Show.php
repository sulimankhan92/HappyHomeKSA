<?php

namespace App\Livewire\CouponUsers;

use App\Livewire\Forms\CouponUserForm;
use App\Models\CouponUser;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Show extends Component
{
    public CouponUserForm $form;

    public function mount(CouponUser $couponUser)
    {
        $this->form->setCouponUserModel($couponUser);
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.coupon-user.show', ['couponUser' => $this->form->couponUserModel]);
    }
}
