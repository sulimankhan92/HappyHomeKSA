<?php

namespace App\Livewire\CouponUsers;

use App\Livewire\Forms\CouponUserForm;
use App\Models\CouponUser;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Create extends Component
{
    public CouponUserForm $form;

    public function mount(CouponUser $couponUser)
    {
        $this->form->setCouponUserModel($couponUser);
    }

    public function save()
    {
        $this->form->store();

        return $this->redirectRoute('coupon-users.index', navigate: true);
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.coupon-user.create');
    }
}
