<?php

namespace App\Livewire\CouponAssignedUsers;

use App\Livewire\Forms\CouponAssignedUserForm;
use App\Models\CouponAssignedUser;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Show extends Component
{
    public CouponAssignedUserForm $form;

    public function mount(CouponAssignedUser $couponAssignedUser)
    {
        $this->form->setCouponAssignedUserModel($couponAssignedUser);
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.coupon-assigned-user.show', ['couponAssignedUser' => $this->form->couponAssignedUserModel]);
    }
}
