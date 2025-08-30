<?php

namespace App\Livewire\CouponAssignedUsers;

use App\Models\CouponAssignedUser;
use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    #[Layout('layouts.app')]
    public function render(): View
    {
        $couponAssignedUsers = CouponAssignedUser::paginate();

        return view('livewire.coupon-assigned-user.index', compact('couponAssignedUsers'))
            ->with('i', $this->getPage() * $couponAssignedUsers->perPage());
    }

    public function delete(CouponAssignedUser $couponAssignedUser)
    {
        $couponAssignedUser->delete();

        return $this->redirectRoute('coupon-assigned-users.index', navigate: true);
    }
}
