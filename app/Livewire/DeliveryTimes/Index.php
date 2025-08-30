<?php

namespace App\Livewire\DeliveryTimes;

use App\Models\DeliveryTime;
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
        $deliveryTimes = DeliveryTime::paginate();

        return view('livewire.delivery-time.index', compact('deliveryTimes'))
            ->with('i', $this->getPage() * $deliveryTimes->perPage());
    }

    public function delete(DeliveryTime $deliveryTime)
    {
        $deliveryTime->delete();

        return $this->redirectRoute('delivery-times.index', navigate: true);
    }
}
