<?php

namespace App\Livewire\Coupons;

use App\Models\Coupon;
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
        $coupons = Coupon::search($this->search)->paginate();

        return view('livewire.coupon.index', compact('coupons'))
            ->with('i', $this->getPage() * $coupons->perPage());
    }

    public function searchCoupon($term){
        $this->search = $term;
    }

    public function delete(Coupon $coupon)
    {
        $coupon->delete();

        return $this->redirectRoute('coupons.index', navigate: true);
    }
}
