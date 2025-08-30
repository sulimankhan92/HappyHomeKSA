<?php

namespace App\Livewire\CouponAssignedUsers;

use App\Livewire\Forms\CouponAssignedUserForm;
use App\Models\CouponAssignedUser;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Edit extends Component
{
    public CouponAssignedUserForm $form;

    public function mount(CouponAssignedUser $couponAssignedUser)
    {
        $this->form->setCouponAssignedUserModel($couponAssignedUser);
    }

    public function save()
    {
        $this->form->update();

        return $this->redirectRoute('coupon-assigned-users.index', navigate: true);
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.coupon-assigned-user.edit');
    }
}
