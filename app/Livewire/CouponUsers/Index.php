<?php

namespace App\Livewire\CouponUsers;

use App\Models\CouponUser;
use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $search = '';

    #[Layout('layouts.app')]
    public function render(): View
    {
        $couponUsers = CouponUser::search($this->search)->paginate();

        return view('livewire.coupon-user.index', compact('couponUsers'))
            ->with('i', $this->getPage() * $couponUsers->perPage());
    }

    public function searchCouponUsers($term){
        $this->search = $term;
    }

    public function delete(CouponUser $couponUser)
    {
        $couponUser->delete();

        return $this->redirectRoute('coupon-users.index', navigate: true);
    }
}
